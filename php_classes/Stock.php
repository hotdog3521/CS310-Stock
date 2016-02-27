<?php
class Stock
{
    // property declaration
    private $name;        //string
    private $symbol;     //string
    private $closingPrice; //Double

    public function __construct($name, $symbol, $closingPrice) {
        //constructor
        $this->name = $name;
        $this->symbol = $symbol;
        $this->closingPrice = $closingPrice;

    }

    // method declaration
    public function setClosingPrice($price) {
        //sets the closing price for the stock

        $this->closingPrice = $price;
    }

    public function getClosingPrice() {
    //return double
    //returns the closing price
        return $this->closingPrice;
    }

     public function getSymbol() {
        //return string
        //returns the symbol

        return $this->symbol;
     }

    public function setSymbol($symbol) {
        // sets the symbol for the stock
        $this->symbol = $symbol;
    }

    public function getName() {
        //return string
        //returns the name
        return $this->name;
    }
    public function setName($name) {
        //sets the name for the stock
        $this->name = $name;
    }

}
?>