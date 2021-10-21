<?php

/**
 * 
 * OO Approach - Code Only Model of Acme Widget Company
 * Copyright 2021 Robert Baxter-Kaneen
 * 
 * Assumtions
 *      I will not write nearly any UI code at all, you well get text test outputs only.
 *      Actually what you want to see as a implementation of the case study as an Object Model for the Basket + Products + Deals
 *      Class function to add a Product to the Basket
 *      Class function to return the total cost of the Basket
 *      
 * Things you didn't want to see
 *      Any UI what so ever
 *      Only code referenced in the case study. Maybe as an "addon" to any existing system.
 * 
 * This file is simply for outputting the logic in a PHP CLI Shell for testing.
 *     
 */

 // Enable PHP errors

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);


 // Require all the Classes

 require_once('basket.class.php');    
 require_once('product.class.php');    
 require_once('offer.class.php');       // Extend the Basket with Current Offers

 // Create the nessisary Instances of each Class for Testing Operations

 $Products['R01'] = new Product("R01", "Red Wiget", 32.95);
 $Products['G01'] = new Product("G01", "Green Wiget", 24.95);
 $Products['B01'] = new Product("B01", "Blue Wiget", 7.95);

 // Testing -- Output the Products Array
 print("<strong>Output of the Constucted Product Catalogue</strong>");
 print("<pre>");
 print_r($Products);
 print("</pre>");

 // Define the Delivery Rules Cost Table

 $DeliveryCosts = array(
    '0'     => 4.95,
    '49.99' => 2.95,
    '89.99'    => 0,
 ); 

 // Define the Offers Currently in Effect

 $CurrentOffers = array("R01" => "applyBOGOH");

 // Testing -- Print out the DeliveryCosts and CurrentOffers arrays.

 print("<strong>Output of Test Cases</strong>");
 print("<pre>");
 print_r($DeliveryCosts);
 print("</pre>");

 // Construct The Test Case Baskets

 $Baskets['test1'] = new Basket($Products, $CurrentOffers, $DeliveryCosts);
 $Baskets['test1']->addToBasket("B01");
 $Baskets['test1']->addToBasket("G01");

 $Baskets['test2'] = new Basket($Products, $CurrentOffers, $DeliveryCosts);
 $Baskets['test2']->addToBasket("R01");
 $Baskets['test2']->addToBasket("R01");

 $Baskets['test3'] = new Basket($Products, $CurrentOffers, $DeliveryCosts);
 $Baskets['test3']->addToBasket("R01");
 $Baskets['test3']->addToBasket("G01");

 $Baskets['test4'] = new Basket($Products, $CurrentOffers, $DeliveryCosts);
 $Baskets['test4']->addToBasket("B01");
 $Baskets['test4']->addToBasket("B01");
 $Baskets['test4']->addToBasket("R01");
 $Baskets['test4']->addToBasket("R01");
 $Baskets['test4']->addToBasket("R01");

// Output the Baskets for Testing

 print("<strong>Test Case 1</strong>");
 print("<br />Base Total: " . $Baskets['test1']->getBaseTotal() . ' <br />');
 print("Discount: " . $Baskets['test1']->calcDiscount() . ' <br />');
 print("Delivery: " . $Baskets['test1']->calcDelivery() . ' <br />');
 print("Basket Total: " . $Baskets['test1']->getTotal() . ' <br />');
 print("<br />");

 print("<strong>Test Case 2</strong>");
 print("<br />Base Total: " . $Baskets['test2']->getBaseTotal() . ' <br />');
 print("Discount: " . $Baskets['test2']->calcDiscount() . ' <br />');
 print("Delivery: " . $Baskets['test2']->calcDelivery() . ' <br />');
 print("Basket Total: " . $Baskets['test2']->getTotal() . ' <br />');
 print("<br />");

 print("<strong>Test Case 3</strong>");
 print("<br />Base Total: " . $Baskets['test3']->getBaseTotal() . ' <br />');
 print("Discount: " . $Baskets['test3']->calcDiscount() . ' <br />');
 print("Delivery: " . $Baskets['test3']->calcDelivery() . ' <br />');
 print("Basket Total: " . $Baskets['test3']->getTotal() . ' <br />');
 print("<br />");

 print("<strong>Test Case 4</strong>");
 print("<br />Base Total: " . $Baskets['test4']->getBaseTotal() . ' <br />');
 print("Discount: " . $Baskets['test4']->calcDiscount() . ' <br />');
 print("Delivery: " . $Baskets['test4']->calcDelivery() . ' <br />');
 print("Basket Total: " . $Baskets['test4']->getTotal() . ' <br />');
 print("<br />");

 // My own Test Case 5 demoing my 10% off order over 100$

 $CurrentOffers = array(
    "R01" => "applyBOGOH",
    "100" => "applyTenPercentOff"
 );

 $Baskets['test5'] = new Basket($Products, $CurrentOffers, $DeliveryCosts);
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("R01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");
 $Baskets['test5']->addToBasket("B01");

 print("<strong>Test Case 5 - Extra</strong>");
 print("<br />Base Total: " . $Baskets['test5']->getBaseTotal() . ' <br />');
 print("Discount: " . $Baskets['test5']->calcDiscount() . ' <br />');
 print("Delivery: " . $Baskets['test5']->calcDelivery() . ' <br />');
 print("Basket Total: " . $Baskets['test5']->getTotal() . ' <br />');
 print("<br />");

 