<?php
//food truck items

$myItem = new Item(1, "Plain Pizza", "Our Hand Tossed Crust and House Blend of 4 Cheeses", 8.99);
$myItem->addExtra("Mushrooms");
$myItem->addExtra("Peppers");
$myItem->addExtra("Sausage");
$config->items[] = $myItem;



$myItem = new Item(2, "Pepperoni", "Our Hand Tossed Crust and House Blend of Cheese, and Pepperoni", 10.99);
$myItem->addExtra("Mushrooms");
$myItem->addExtra("Peppers");
$myItem->addExtra("Sausage");
$config->items[] = $myItem;



$myItem = new Item(3, "Hawaiian", "Our Hand Tossed Crust and House Blend of 4 Cheeses, Local Ham, and Pineapple", 12.99);
$myItem->addExtra("Mushrooms");
$myItem->addExtra("Peppers");
$myItem->addExtra("Sausage");
$config->items[] = $myItem;
