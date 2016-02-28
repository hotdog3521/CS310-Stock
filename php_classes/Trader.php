<?php

class Trader
{
    // property declaration
    private $mAPI;        //APIManager
    private $portfolioManager;     //PortfolioManager

    public function  __construct($mAPI, $portfolioManager) {
        //constructor
        $this->mAPI = $mAPI;
        $this->portfolioManager = $portfolioManager;

    }

    // method declaration
    public function isStock($companyName) {
        //verifies if the specified stock name is valid or not.
    }
    public function canBuy($stock,$quantity) {
        //verifies if the user has sufficient funds to buy the stock at the given quantity.
    }
    public function buyStock($stock, $quantity) {
        //accesses the API and purchases the stocks And update user’s portfolio.

    }
    public function sellStock($stock, $quantity) {
        //accesses the API and sells the stocks. And update user’s portfolio
    }

}
?>