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
        $this->mWatchList = $watchList;
        $this->netPortfolioValue = $netPortfolioValue;
        $this->mStockList = $mStockList;

    }

    //returns true if Portfolio’s balance has been set successfully, and false otherwise.
    public function setBalance($balance) {

        $this->accountBalance = $balance;
    }

    // returns the portfolio net balance
    public function getBalance() {

        return $this->accountBalance;
    }

    // returns the portfolio net value
    public function getnetPortfolioValue() {

        return $this->netPortfolioValue;
    }

    // sets the portfolio net value
    public function setNetPortfolioValue($newValue) {

        $this->netPortfolioValue = $newValue;
    }

    //returns the populated Portfolio List array
    public function getStockList($user) {

        return $this->mStockList;
    }

    // adds a stock to the Portofolio List array
    public function addStock($stock) {

        if (in_array($stock->getName(), $mStockList)){
            array_push($mStockList, $stock->getName(), $stock);
        }
    }

    // removes a stock from the Portfolio List array
    public function removeStock($stock) {
        
        if (in_array($stock->getName(), $mStockList)){
            unset($mStockList[$stock->getName()]);
        }
    }

    // returns the populated WatchList array
    public function  getWatchList($user) {

        return $this->mWatchList;
    }

    // adds a stock to the Watchlist array
    public function addToWatchList($stock) {

        if (in_array($stock->getName(), $mWatchList)){
            array_push($mWatchListList, $stock->getName(), $stock);
        }
    }

    // removes a stock from the Watchlist array
    public function removeFromWatchList($stock) {

        if (in_array($stock->getName(), $mWatchList)){
            unset($mWatchList[$stock->getName()]);
        }
    }

}
?>