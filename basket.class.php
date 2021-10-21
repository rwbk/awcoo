<?php

/**
 * 
 * OO Approach - Code Only Model of Acme Widget Company
 * Copyright 2021 Robert Baxter-Kaneen
 * 
 * Basket Class
 * 
 * Defines an object of type Basket for Shopping Cart Type Logic
 *   
 */

 class Basket {
    
    // Private Variables associated with a Basket Logic

    private $productCatalogue = array();        // Product Catalogue of everything the Customer could buy.
    private $productOffers = array();           // Any offers that exist that supports the offers QTY discount logic.
    private $deliveryRules = array();           // Array of Delivery costs for Basket Totals.
    private $addedItems = array();              // Array of Added Items to the Basket. 

    private $discount = 0;                      // We can add a Discount to the Basket as a Money Value. It will come off the total. 
    private $deliveryCost = 0;                  // Basket Delivery Cost is set here once calculated. 

    // Constructor is called upon creating the Object, it requires being passed the Product Catalogue, Offers Avalible & Delivery Rules.
    function __construct($products, $offers, $deliveryRules) 
    {

        // Add the given peramiters to the Class Varibles for this instance
        $this->productCatalogue =       $products;
        $this->productOffers =          $offers;
        $this->deliveryRules =          $deliveryRules;

    }

    // Adds a Product from the Catalogue to the Basket
    public function addToBasket($productCode)
    {
        if (isset($this->productCatalogue[$productCode]))
        {
            // Add the Product to the Basket Items List. 
            $this->addedItems[] = $this->productCatalogue[$productCode];
        } else {
            // There is no Product in the Catalogue with the code given. So it must be an error!
            return false; 
        }
    }

    // Returns the Basket List for Testing if we need it.
    public function getAddedItems()
    {
        return $this->addedItems;
    }

    // Sets the Basket Discount to any value
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    // Calculate Discount based on Passed Offers avalible to the Basket

    public function calcDiscount()
    {
        $discount = 0;
        $OfferCalc = new Offers($this);
        foreach ($this->productOffers as $context => $offerFunc) // $offerFunc is the Class Public Function in Offers Class to run on the basket. 
        {
            $getDiscount = $OfferCalc->$offerFunc($context);
            if ($getDiscount <> false)
            {
                // If the above is false, then no discount is found. This escapes that now we can apply the discount
                $discount = $discount + $getDiscount;
            }
        }
        $this->discount = $discount;
        return $discount;
    }

    // Returns the Basket Total WITHOUT any Discount or Delivery
    public function getBaseTotal()
    {
        // Calc the Total
        $total = 0;
        foreach($this->addedItems as $itemID => $item)
        {
            $total = $total + $item->getPrice();
        }
        
        // return the Basket Base Total
        return $total;
    }

    // Returns the Basket Delivery Cost. Note: this is applied to the Discounted Total Price, not the Base Price. 
    public function calcDelivery()
    {
        // Loop the Delivery Rules to find the Delivery Cost and Add that to the Total
        $deliveryToApply = false;
        foreach ($this->deliveryRules as $rule => $cost)
        {
            if (($this->getBaseTotal() - $this->discount) > $rule)
            {
                $deliveryToApply = $cost;
            }
        }
        $this->deliveryCost = $deliveryToApply; 
        return $deliveryToApply;
    }

    // Returns the Basket Total - Discount + Delivery. In that order.
    public function getTotal()
    {
        $this->calcDiscount();
        $this->calcDelivery();
        $total = $this->getBaseTotal() - $this->discount + $this->deliveryCost;
        return round($total,2);
    }


 }
