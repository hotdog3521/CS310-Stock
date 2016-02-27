<?php
include 'APIManager.php';
include 'Portfolio.php';
include 'DBManager.php';
include 'Portfolio.php';
include 'Stock.php';

class PortfolioManager
{
    // property declaration
    private $mDB; //DBManager
    private $mAPI; //APIManager
    private $mUser; //User
    private $mPortfolio; //Portfolio
    private $mVisibleStocks = array(

    );

    public function __construct($mUser, $mPortfolio, $mVisibleStocks) {
        //constructor
        $this->mDB = new DBManager();
        $this->mAPI = new APIManager();
        $this->mUser = $mUser;
        $this->mPortfolio = $mPortfolio;
        $this->mVisibleStocks = $mVisibleStocks;
    }

    // method declaration
    public function logout() {
        //returns true or false depending on the status of the logout process
        //boolean function
    }
    public function getVisibleStocks($stockPrefix) {
        //return array of stock mVisibleStocks
        //returns the list of visible stocks for the mainGraph class to use

        return $this->mVisibleStocks;
    }
    public function setBalance($balance) {
        //return boolean
        //calls the portfolio’s setBalance funciton.

        $this->mPortfolio->setBalance($balance);
    }
    public function getBalance() {
        //return double
        //returns portfolio’s net balance

        return $this->mPortfolio->getBalance();
    }
    public function getNetPortfolioValue(){
        //returns portfolio’s net value

        return $this->mPortfolio->getNetPortfolioValue();
    }
    public function getStockList($user) {
        // return Portfolio
        //calls the getStockList function inside the $mPortfolio;

        return $this->mPortfolio->getStockList($user);
    }
    public function addStock($stock) {
        //calls the addStock method in $mPortfolio

        $this->mPortfolio->addStock($stock);
    }
    public function removeStock($stock) {
        //calls the removeStock method $mPortfolio

        $this->mPortfolio ->removeStock($stock);
    }
    public function getWatchList($user) {
        //calls the getWatchList function in $mPortfolio 

        return $this->mPortfolio->getWatchList();
    }
    public function addToWatchList($stock) {
        //calls the addToWatchList function in $mPortfolio

        $this->mPortfolio->addToWatchList($stock);
    }
    public function removeFromWatchList($stock) {
        //calls the removeFromWatchList function in $mPortfolio
        $this->mPortfolio->removeFromWatchList($stock);
    }
    public function uploadCSV($filePath) {
        //calls the uploadCSV function in $mPortfolio
        $this->mPortfolio->uploadCSV($filePath);
    }


}
?>