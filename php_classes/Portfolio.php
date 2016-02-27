<?php
class PortfolioManager
{
    // property declaration
    private $accountBalance;        //Double
    private $netPortfolioValue;     //Double
    private $mStockList = array(
            //array of stock
    );
    private $watchList = array(
            //array of stock
    );

    public function __construct($watchList, $accountBalance, $netPortfolioValue, $mStockList) {
        //constructor
        this->accountBalance = $accountBalance;
        this->watchList = $watchList;
        this->netPortfolioValue = $netPortfolioValue;
        this->mStockList = $mStockList;

    }

    // method declaration
    public function setBalance($balance) {
        //return boolean
        //returns true if Portfolio’s balance has been set successfully, and false otherwise.
    }
    public function getBalance() {
        //return double
        //returns portfolio’s net balance
    }
    public function getnetPortfolioValue() {
        //return double
        //returns portfolio's net value
    }
    public function setNetPortfolioValue($newValue) {
        //Usage: sets the $netPortfolioValue to the passed in parameter
    }
    public function getStockList($user) {
        //return Portfolio
        //returns a populated Portfolio object with data pulled from DBManager
    }
    public function addStock($stock) {
        //calls the addStock method in DBManager, then adds that stock to the current Portfolio object
    }
    public function removeStock($stock) {
        //calls the removeStock method in DBManager, then removes that stock from the current Portfolio object
    }
    public function  getWatchList($user) {
        //return watchlist
        //returns the watchlist
    }
    public function  addToWatchList($Stock) {
        //Usage: adds a stock to the watchList
    }
    public function function  removeFromWatchList($Stock) {
        //removes a stock from the watchlist
    }
    public function uploadCSV($filePath) {
        //Usage: read csv file and update user’s portfolio and database
    }

}
?>