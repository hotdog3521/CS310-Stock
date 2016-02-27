<?php
class Portfolio
{
    // property declaration
    private $accountBalance;        //Double
    private $netPortfolioValue;     //Double
    private $mStockList = array(
            //array of stock
    );
    private $mWatchList = array(
            //array of stock
    );

    public function __construct($mWatchList, $accountBalance, $netPortfolioValue, $mStockList) {
        //constructor
        $this->accountBalance = $accountBalance;
        $this->mWatchList = $watchList;
        $this->netPortfolioValue = $netPortfolioValue;
        $this->mStockList = $mStockList;

    }

    // method declaration
    public function setBalance($balance) {
        //return boolean
        //returns true if Portfolio’s balance has been set successfully, and false otherwise.

        $this->accountBalance = $balance;
    }
    public function getBalance() {
        //return double
        //returns portfolio’s net balance

        return $this->accountBalance;
    }
    public function getnetPortfolioValue() {
        //return double
        //returns portfolio's net value

        return $this->netPortfolioValue;
    }
    public function setNetPortfolioValue($newValue) {
        //Usage: sets the $netPortfolioValue to the passed in parameter

        $this->netPortfolioValue = $newValue;
    }
    public function getStockList($user) {
        //return Portfolio
        //returns a populated Portfolio object with data pulled from DBManager

        return $this->mStockList;
    }
    public function addStock($stock) {
        //calls the addStock method in DBManager, then adds that stock to the current Portfolio object

        if (in_array($stock->getName(), $mStockList)){
            array_push($mStockList, $stock->getName(), $stock);
        }
    }
    public function removeStock($stock) {
        //calls the removeStock method in DBManager, then removes that stock from the current Portfolio object
        
        if (in_array($stock->getName(), $mStockList)){
            unset($mStockList[$stock->getName()]);
        }
    }

    public function  getWatchList($user) {
        //return watchlist
        //returns the watchlist

        return $this->mWatchList;
    }
    public function addToWatchList($stock) {
        //Usage: adds a stock to the watchList

        if (in_array($stock->getName(), $mWatchList)){
            array_push($mWatchListList, $stock->getName(), $stock);
        }
    }
    public function removeFromWatchList($stock) {
        //removes a stock from the watchlist
        if (in_array($stock->getName(), $mWatchList)){
            unset($mWatchList[$stock->getName()]);
        }
    }
    public function uploadCSV($filePath) {
        //Usage: read csv file and update user’s portfolio and database
    }

}
?>