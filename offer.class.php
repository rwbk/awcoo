<?php

/**
 * 
 * OO Approach - Code Only Model of Acme Widget Company
 * Copyright 2021 Robert Baxter-Kaneen
 * 
 * Offer Class
 * 
 * The Offer Class takes the Basket class object and applys offers against it. My example is the Case Studies "Buy One, Get One Half Price". 
 *   
 */

 class Offers {

   // Private Variables for the Offers

   private $discount = 0;
   private $basket = null;

   // at Constuction we take the Basket as an object. We then apply as many "offer functions" against it as we like. 

   function __construct($basket)
   {
      $this->basket = $basket;
   }

   // Applys a Buy one get one half price logic against a specific product.
   public function applyBOGOH($code)
   {
      $countItems = 0;
      foreach ($this->basket->getAddedItems() as $id => $item)
      {
         if ($item->getCode() == $code)
         {
            $countItems = $countItems + 1;
         }
      }

      if ($countItems >= 2)
      {
         $discount = ($item->getPrice() / 2);
         $this->discount = round($this->discount + $discount,2);
         return round($discount,2);
      } else {
         return false;
      }
   }

   // Add your further discount logic here ...
   // Not asked for but added for demo purposes of my ability. 

   public function applyTenPercentOff($minval)
   {
      if ($this->basket->getBaseTotal() >= $minval)
      {
         $discount = (($this->basket->getBaseTotal() / 100) * 10);
         $this->discount = round($this->discount + $discount,2);
         return round($discount,2);
      } else {
         return false;
      }
   }

   // Get the Discount Calculated

   public function getDiscount()
   {
      return round($this->discount, 2);
   }

 }
