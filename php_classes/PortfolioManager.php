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

        $newBalance = 0; //double
        //define array for stock list
        $csvfile = array(


        );

        $newStockList = array(

        );

        
        // replace the current Portfolio with the new one uploaded
        $csv_reader = fopen($filePath, 'r');
        while(!fof($file_handle) ) {
            $csvfile[] = fgetcsv($csv_reader);
        }
        fclose($myfile);
        //get the new stocklist from csvfile array
        for($i = 0; $i < count($csvfile); ++$i) {
            
            if($i !== count($csvfile)-1) {
                $newStockList[$i] = $csvfile[$i];
            }else {
                //last element of the csvfile is balance of the user
                $newBalance = $csvfile[$i];
            }
            
        }



        $newPortfolio = new Portfolio($this->getWatchList(), $newBalance, $this->getNetPortfolioValue(), $newStockList);
        $mPortfolio = $newPortfolio;
        


        $this->savePortfolio();
    }


}
?>