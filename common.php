<?php 
/**
 * showForm() shows the form to user to input quantity for the pizza order
 */

function showForm() {# shows form so user can enter their order.  Initial scenario
    global $config;
	get_header(); #defaults to header_inc.php	
	
	echo 
	'<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourOrder,"Please enter the quantity you would like to order")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3>
	<p align="center">Please enter the quantity you would like to order</p> 
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
		<table align="center">
			<tr>
				
				<td>
                ';
    /*
     ' . XXX . '
    */
    
    
    $checkCount = 1;
    
    foreach($config->items as $item) {
        //initialize checkboxes 
        $cbox1 = "cbox1" . strval($checkCount);
        $cbox2 = "cbox2" . strval($checkCount);
        $cbox3 = "cbox3" . strval($checkCount);
        echo '<p>' . $item->Name . '    Description: ' . $item->Description . '</p><p>Price : $' . $item->Price . '      Extra Toppings ($0.50 extra each): 
        <label><input type="checkbox" name="' . $cbox1 . '" value="mushrooms"> Mushrooms</label>
        <label><input type="checkbox" name="' . $cbox2 . '" value="peppers"> Peppers</label>
        <label><input type="checkbox" name="' . $cbox3 . '" value="sausage"> Sausage</label></p>
        <p>Quantity: <input type="text" name="item_' . $item->ID . '"/></p>';
        
        //adds count to checkboxes to verify which checkbox is checked
        $checkCount = $checkCount + 1;            
    }
    
    echo ' 
    <!--
    <input type="text" name="YourOrder" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
    -->
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="submit" value="Submit Your Order">
            </td>
        </tr>
    </table>
    <input type="hidden" name="act" value="display" />
	</form>
	';
	get_footer(); #defaults to footer_inc.php
}

  /**
   * showData() shows the form again with the Subtotal, Tax, and Total amounts included from the order placed
   * also contains a back button in case user would like to enter in another order
   */
function showData() {
    global $config;
    
    echo 
	'<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourOrder,"")){return false;}
			return true; //if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3> 
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
		<table align="center">
			<tr>
				<td>
                ';
               echo ' 
                <!--
					<input type="text" name="YourOrder" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
                    -->
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<!--<input type="submit" value="Submit Your Order"><em>(<font color="red"><b>*</b> required field</font>)</em>
                    -->
				</td>
			</tr>
		</table>
		<input type="hidden" name="act" value="display" />
	</form>
	';
    //initializing variables
    $counter = 1;
    $subTotal = 0;
    $checkCount = 1;
    
    //looping through items
    foreach($config->items as $item){
        //adds count to item
        $itemCount = "item_" . strval($counter);
        foreach($_POST as $name => $value)
        {
            //if string contains name and item count
            if(strstr($name, $itemCount)) 
            {
                //checks for numerical input
                if (is_numeric($value) || empty($value))
                {
                    //adds quanity input to variable
                    $quantity = intval($value);
                //tells user only numbers are allowed and redirects back to page    
                } else
                    {
                        feedback("Only numbers are allowed.  Please re-enter your quantity."); #will feedback to submitting page via session variable
                        myRedirect(THIS_PAGE);
                    }
            }
        }
        //calculations for item total
        $itemTotal = $item->Price * $quantity;
        
        //subtotal calculation
        $subTotal += $itemTotal;
        
        $cbox1 = "cbox1" . strval($checkCount);
        $cbox2 = "cbox2" . strval($checkCount);
        $cbox3 = "cbox3" . strval($checkCount);
        
        //adds extra values if checked
        if(isset($_POST[$cbox1]))
        {
            $subTotal += (.5 * $quantity);
        }
        if(isset($_POST[$cbox2]))
        {
            $subTotal += (.5 * $quantity);
        }
        if(isset($_POST[$cbox3]))
        {
            $subTotal += (.5 * $quantity);
        }
        
        $counter = $counter + 1;
        $checkCount = $checkCount + 1;
        
    }
    //figueres out tax amount
    $tax = $subTotal * .095;
    
    //calculates total plus tax
    $total = $subTotal + $tax;
    
    if ($total == 0) {
        feedback("Please make a selection."); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
    }
    
    //prints out receipt total
    echo '<p align="center">Subtotal: $' . $subTotal . '</p>';
    echo '<p align="center">Tax: $' . number_format($tax, 2) . '</p>';
    echo '<p align="center">Total: $' . number_format($total, 2) . '</p>';
    echo '<p align="center"><a href="' . THIS_PAGE . '">Place another order</a></p>';
    
	get_header(); #defaults to footer_inc.php
	get_footer(); #defaults to footer_inc.php
}
