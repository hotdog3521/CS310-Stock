<?php
class Stock
{
    // property declaration
    private $name;        //string
    private $symbol;     //string
    private $closingPrice; //Double
    private $quantity; //integer
    private $id;

    // constructor for building a new stock
    public function __construct($name, $symbol, $closingPrice,$quantity, $id) {
	if($closingPrice<0) {$closingPrice=0;}
        $this->name = $name;
        $this->symbol = $symbol;
        $this->closingPrice = round(abs($closingPrice),2);
        $this->quantity= 1;
        $this->id = $id;

    }

    // set the closing price for a stock
    public function setClosingPrice($price) {
	if($price<0) 
	{$price=0;}
        $this->closingPrice = round(abs($price),2);
    }

    // returns the closing price
    public function getClosingPrice() {

        return $this->closingPrice;
    }

    // returns the ticker symbol
    public function getSymbol() {

        return $this->symbol;
    }

    // sets the ticker symbol of a stock
    public function setSymbol($symbol) {
        // sets the symbol for the stock
        $this->symbol = $symbol;
    }

    // returns the name of the company
    public function getName() {

        return $this->name;
    }

    // sets the name of the company stock
    public function setName($name) {

        $this->name = $name;
    }

    // returns the quantity of the stock
    public function getQuantity() {

        return $this->quantity;
    }

    // sets the quantity of the stock
    public function setQuantity($quantity){
        $this->quantity=$quantity;
    }

    // returns the stock ID as listed in the MySQL database
    public function getId(){
        return $this->id;
    }
}
?>
