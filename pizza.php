<?php

error_reporting(0);

$pizzas = array(
	array("name"=>"Cheese Pizza", "price"=>8.99),
	array("name"=>"Pepperoni Pizza", "price"=>10.99),
	array("name"=>"Hawaiian Pizza", "price"=>12.99)
);

if ($_REQUEST) {
	//Form submitted
	$order = '';
	$subtotal = 0;
	
	foreach ($_REQUEST as $key=>$item) {
		if ($item['quantity']>0) {
			$multiple = '';
			if ($item['quantity']>1) {
				$multiple = 's';
			}
			$toppings = '';
			if ($item['toppings']) {
				$toppings = '<br>Add: ';
				foreach ($item['toppings'] as $name=>$value) {
					$toppings .= ucwords($name).', ';
					$subtotal = $subtotal+0.5;
				}
				$toppings = substr($toppings, 0, -2);
			}
			$order .= '<p class ="confirmation">'.$item['quantity'].' '.$pizzas[$key]['name'].$multiple.$toppings.'</p>';
			$subtotal = $subtotal+($item['quantity']*$pizzas[$key]['price']);
		}
	}
	$tax = $subtotal*0.1;
	$total = $subtotal+$tax;
    $tax = number_format($tax, 2);
    $subtotal = number_format($subtotal, 2);
    $total = number_format($total, 2);
}

?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Karla|Pacifico" rel="stylesheet">
<link href="pizza_style.css" rel="stylesheet">
<title>Pizza Truck</title>
</head>

<body>
    <header id="banner"></header>
	<div id="container" class="col-1">
		<h1 class="center">Pizza Time, Dog</h1>
        <br>
		<?php if ($order): ?>
		<h2>Your order:</h2>
		<?= $order; ?>
		<p class="confirmation"><strong>Subtotal:</strong> $<?= $subtotal ?><br><strong>Tax:</strong> $<?= $tax; ?><br><strong>Total:</strong> $<?= $total; ?></p>
		<?php else: ?>
		<form method="post">
			<?php foreach($pizzas as $key=>$pizza): ?>
			<label><?= $pizza['name'].' - $'.$pizza['price']; ?></label>
			<p class="label">Quantity</p>
			<input type="number" name="<?= $key; ?>[quantity]" value="0" id="quantity" min="0" pattern="\d*">
            <br>
			<label>Additional Toppings (+$0.50 each)</label>
			<div class="checkboxes">
				<input type="checkbox" name="<?= $key; ?>[toppings][mushrooms]" id="item<?= $key; ?>-mushrooms"><label for="item<?= $key; ?>-mushrooms">Mushrooms</label>
                <br>
				<input type="checkbox" name="<?= $key; ?>[toppings][peppers]" id="item<?= $key; ?>-peppers"><label for="item<?= $key; ?>-peppers">Peppers</label>
                <br>
				<input type="checkbox" name="<?= $key; ?>[toppings][sausage]" id="item<?= $key; ?>-sausage"><label for="item<?= $key; ?>-sausage">Sausage</label>
                <br>
			</div>
			<?php endforeach; ?>
			<input type="submit" value="Pizza Me!" id="button">
		</form>
		<?php endif; ?>
	</div>
</body>
</html>