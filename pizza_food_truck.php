<?php
/**
 * pizza_food_truck.php is a single page web application that allows us take a food order from a user
 *
 * This version uses no HTML directly so we can code collapse more efficiently
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch 
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 * 
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the 
 * unique identifier for the next step of a multi-step process
 *
 * @Dan, Aliya, Sue & Marcus (with some help from Bill Newman!)
 * @version 1.0 2018/01/29
 * @link  
 * @license http://www.apache.org/licenses/LICENSE-2.0 
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
require 'Item.class.php'; #This class enables the ability to store data from the order in an object
require 'common.php'; #Critical functionality, particularly the showForm() & showData() functions 

if(isset($_REQUEST['act'])){
    $myAction = (trim($_REQUEST['act']));
} else {
    $myAction = "";
}

switch ($myAction) {
	case "display":
	 	showData();
	 	break;
	default: 
	 	showForm();
        break;
}
