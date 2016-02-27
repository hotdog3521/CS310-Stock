<?php
class Stock
{
    // property declaration
    private $name;        //string
    private $symbol;     //string
    private $closingPrice; //Double

    public function __construct($name, $symbol, $currprice, $currtime) {
        //constructor
        $this->name = $name;
        $this->symbol = $symbol;

    }

    // method declaration
    public function setClosingPrice($price) {
        //sets the closing price for the stock
    }

    public function getClosingPrice() {
    //return double
    //returns the closing price
    }

     public function getSymbol() {
        //return string
        //returns the symbol
     }

    public function setSymbol($symbol) {
        // sets the symbol for the stock
    }

    public function getName() {
        //return string
        //returns the name
    }
    public function setName($name) {
        //sets the name for the stock
    }

}
?>