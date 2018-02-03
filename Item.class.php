<?php
/**
* Item Class creates item from the customer's pizza order
*
*
*<code>
* $myItem= new Item($ID, $Name, $Description, $Price, $Extras);
*</code>
*
*/
//includes items for food truck
include 'foodtruckitems.php';

class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
    
    public function __construct($ID, $Name, $Description, $Price)
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;
        
    }#end item constructor
    
        public function addExtra($extra)
    {
        $this->Extras[] = $extra;
    }#end addExtra
    
}
