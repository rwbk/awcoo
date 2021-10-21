<?php

/**
 * 
 * OO Approach - Code Only Model of Acme Widget Company
 * Copyright 2021 Robert Baxter-Kaneen
 * 
 * Product Class
 * 
 * Defines an object of type Product that represents a Product Item in an array forming a ProductCalalogue
 *   
 */

 class Product {
    
    // Private Variables of a Product

    private $code = array();                    // ID of the Product
    private $name = array();                    // Human readable name of the Product
    private $price = array();                   // Price of the Product

    // Constructor is called upon creating the Object, 
    function __construct($code, $name, $price) 
    {

        // Add the given peramiters to the Class Varibles for this instance
        $this->code =       $code;
        $this->name =       $name;
        $this->price =      $price;

    }

    // Simply returns the Private Price;
    public function getPrice()
    {
        return $this->price; 
    }

    // Simply returns the Private Name;
    public function getName()
    {
        return $this->name; 
    }

    // Simply returns the Private Code;
    public function getCode()
    {
        return $this->code; 
    }

 }