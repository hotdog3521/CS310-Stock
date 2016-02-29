<?php
include 'Portfolio.php';
include 'Stock.php';
include 'DBManager.php';


class PortfolioManager
{
    // property declaration
    private $mUsername;
    private $mDB; //DBManager
    private $mAPI; //APIManagers
    private $mPortfolio; //Portfolio
    private $mVisibleStocks = array(

    );

    public function __construct($username, $API, $email, $password) {
        //constructor

        $this->mDB = new DBManager();
        $this->mAPI = $API;
        $this->mUsername = $username;
        
        // get the user specified in the database
        





        $this->loadPortfolio($email, $password);
    }

    // method declaration
    public function logout() {
        //returns true or false depending on the status of the logout process
        //boolean function
    }
    public function loadPortfolio($email, $password){
        // access the corresponding information from MySQL to create a NEW portfolio

        $user = $this->mDB->login($email, $password);

        $watchlist_id = $user[0]->watchlist_id;

        $tempWatchList = $this->mDB->getWatchList($watchlist_id); 
        $tempProfileList = array();


        $this->mPortfolio = new Portfolio(null, 0, 0, null);
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
        $csv_reader = NULL;     //csv file
        $csvfile = array();
        $newStockList = array();
        $index = 0;
        //getting csv and put that into array
        if(($csv_reader = fopen($filePath, 'r')) !== FALSE) {

            while(($row = fgetcsv($csv_reader, 1000, ',')) !== FALSE) {

                if(!$csv_reader) {
                    $csv_reader = $row;
                } else {
                    $csvfile[] = array_combine($csv_reader, $row);
                } 
                fclose($csv_reader);
            }
        }

        //create new stock list that has stock object in it.
        foreach (csvfile as $key => $value) {
            
            
            if($index !== count($csvfile)-1) {
                $stock = new Stock($key, null, null, $value);
                $newStockList[$index] = $stock;
                $index++;
            }else {
                //last element of the csvfile is balance of the user
                $newBalance = $key;
            }
        }

        $newPortfolio = new Portfolio($this->getWatchList(), $newBalance, $this->getNetPortfolioValue(), $newStockList);
        $mPortfolio = $newPortfolio;
        


        $this->savePortfolio();
    }


}
?>