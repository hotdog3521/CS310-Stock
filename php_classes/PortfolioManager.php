<?php
class PortfolioManager
{
    // property declaration
    private $mDB; //DBManager
    private $mAPI; //APIManager
    private $mUser; //User
    private $mPortfolio; //Portfolio
    //private $mVisibleStocks; //array(stock)


    public function PortfolioManager() {
        //constructor
    }


    // method declaration
    public function getStockInfo($companyName) {
    	//Given a company name in String form, this function queries the finance API and returns the stock’s information
    }
    public function getStocksStartingWith($stockPrefix) {
    	//Given a String input, this function returns an array of stocks with matching characters as the inputted string. 
    }

}
?>