<?php
include 'Portfolio.php';
include 'DBManager.php';
include 'Stock.php';

class PortfolioManager
{
    // property declaration
    private $mUsername;
    private $mDB; //DBManager
    private $mAPI; //APIManagers
    private $mPortfolio; //Portfolio
    private $mVisibleStocks = array(

    );

    public function __construct($username, $API) {
        //constructor
        $this->username = $username;

        $this->mDB = new DBManager();
        $this->mAPI = $API;
        $this->mUsername = $username;
        $this->mPortfolio = new Portfolio(null, 0, 0, null);
        $this->mVisibleStocks = $mVisibleStocks;

        $this->loadPortfolio();
    }

    // method declaration
    public function logout() {
        //returns true or false depending on the status of the logout process
        //boolean function
    }
    public function loadPortfolio(){

        // should take the username and access the corresponding information from MySQL to create a NEW portfolio
    }
    public function savePortfolio(){
        // should take the current Portfolio stored in $mPortfolio, and update the MySQL tables according to its info
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
    public function getStockList() {
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
    public function getWatchList() {
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

        //structure of csv 
        //STOCK_TICKER_NAME, DATE_BOUGHT_DOLLARS, PRICE_BOUGHT, NUMBER_OF_SHARES
        //NFLX                11/2/2015             108.92         10

        $newBalance = 0; //double
        $csv_reader = NULL;     //csv file
        $newStockList = array();
        $index = 0; //for new stock list

        //getting csv and put that into array
        if(($csv_reader = fopen($filePath, 'r')) !== FALSE) {
            //read line by line
            //data is array that contains all elements in a row.
            while(($data = fgetcsv($csv_reader, 1000, ',')) !== FALSE)  {
                $numElementInRow = count($data); //number of element in a row

        
                $ticker = $data[1];
                $boughtDate = $data[2];
                $boughtPrice = $data[3];
                $numberShares = $data[4];

                //calculating new balnce for newPortfolio
                $newBalance += $boughtPrice * $numberShares;

                //error checking if ticker is in the API
                //if not, just don't add it and don't add up to the new balance
                //syntax for stock -> Stock($name, $symbol, $closingPrice, $quantity)
                $stock = new Stock($ticker, $ticker, $boughtPrice, $numberShares);
                $newStockList[$index] = $stock;
                $index++;
                //calculating new balnce for newPortfolio
                $newBalance += $boughtPrice * $numberShares;
                
                
            }
            fclose($csv_reader);
        }
 
        $newPortfolio = new Portfolio($this->getWatchList(), $newBalance, $this->getNetPortfolioValue(), $newStockList);
        $mPortfolio = $newPortfolio;
        
        $this->savePortfolio();
    }


}
?>