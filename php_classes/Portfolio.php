<?php

class Portfolio
{
    // property declaration
    private $accountBalance;        //Double
    private $netPortfolioValue;     //Double
    private $mStockList = array();
    private $mWatchList = array();

    // constructor to make a new portfolio
    public function __construct($mWatchList, $accountBalance, $netPortfolioValue, $mStockList) {
        $this->accountBalance = $accountBalance;
        $this->mWatchList = $mWatchList;
        $this->netPortfolioValue = $netPortfolioValue;
        $this->mStockList = $mStockList;

    }

    //returns true if Portfolio’s balance has been set successfully, and false otherwise.
    public function setBalance($balance) {

        if ($balance < 0){
            $this->accountBalance = 0;
        } else {
            $this->accountBalance = $balance;
        }
    }

    // returns the portfolio net balance
    public function getBalance() {

        return $this->accountBalance;
    }

    // returns the portfolio net value
    public function getNetPortfolioValue() {

        return $this->netPortfolioValue;
    }

    // sets the portfolio net value
    public function setNetPortfolioValue($newValue) {

        if ($newValue < 0){
            $this->netPortfolioValue = 0;
        } else {
            $this->netPortfolioValue = $newValue;
        }
    }

    //returns the populated Portfolio List array
    public function getStockList() {

        return $this->mStockList;
    }

    // adds a stock to the Portofolio List array
    public function addStock($stock) {

        if (!array_key_exists($stock->getName(), $this->mStockList)){
            $this->mStockList[$stock->getName()] = $stock;
        }
    }

    // removes a stock from the Portfolio List array
    public function removeStock($stock) {
        
        if (array_key_exists($stock->getName(), $this->mStockList)){
            unset($this->mStockList[$stock->getName()]);
        }
    }

    // returns the populated WatchList array
    public function  getWatchList() {

        return $this->mWatchList;
    }

    // adds a stock to the Watchlist array
    public function addToWatchList($stock) {

        if (!array_key_exists($stock->getName(), $this->mWatchList)){
            $this->mWatchList[$stock->getName()] = $stock;
        }
    }

    // removes a stock from the Watchlist array
    public function removeFromWatchList($stock) {

        if (array_key_exists($stock->getName(), $this->mWatchList)){
            unset($this->mWatchList[$stock->getName()]);
        }
    }

}
?>