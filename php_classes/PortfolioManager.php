<?php
include 'Portfolio.php';
include 'Stock.php';
include 'DBManager.php';
ini_set("display_errors", "on");


class PortfolioManager
{
    // property declaration
    private $mUsername;
    private $mDB; //DBManager
    private $mAPI; //APIManagers
    private $mPortfolio; //Portfolio
    private $watchlist_id;
    private $portfolio_id;
    private $mVisibleStocks = array(

    );

    private $userId;
    private $portfolioId;

    public function __construct($id)
    {
        $this->mDB = new DBManager();
        $this->userId = $id;
        $this->portfolioId = $this->mDB->getPortfolioId($id);
    }

    // public function __construct($username, $API, $email, $password) {
    //     //constructor

    //     $this->mDB = new DBManager();
    //     $this->mAPI = $API;
    //     $this->mUsername = $username;
        
    //     // get the user specified in the database
    //     // $this->loadPortfolio($email, $password);
    // }

    // method declaration
    public function logout() {
        //returns true or false depending on the status of the logout process
        //boolean function
    }
    public function loadPortfolio($email, $password){
        // access the corresponding information from MySQL to create a NEW portfolio

        // $user = $this->mDB->loginAuthenticate($email, $password);

        // $watchlist_id = $user[0]->watchlist_id;

        // $tempWatchList = $this->mDB->getWatchList($watchlist_id); 
        // $tempProfileList = array();

        // get the user info array from the email/password
        $user = $this->mDB->login($email, $password);

        // get the user's watchlist_id and portfolio_id
        $this->watchlist_id = $user[0]->watchlist_id;
        $this->portfolio_id = $user[0]->portfolio_id;

        // load in the watchList and portfolioList from MySQL
        $tempWatchList = $this->mDB->getWatchList($this->watchlist_id); 
        $tempProfileList = $this->mDB->getPortfolioList($this->portfolio_id);


        // $this->mPortfolio = new Portfolio(null, 0, 0, null);
        // create a new Portfolio and set it to the member variable
        $this->mPortfolio = new Portfolio($tempWatchlist, 0, 0, $tempProfileList);
    }
    public function savePortfolio(){
        // should take the current Portfolio stored in $mPortfolio, and update the MySQL tables according to its info
        $this->mDB->updateWatchList($this->watchlist_id, $mPortfolio->getWatchList());
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

        // return $this->mPortfolio->getStockList($user);

        return $this->mDB->getPortfolio($this->userId);



    }
    public function addStock($stock) {
        //calls the addStock method in $mPortfolio

        // $this->mPortfolio->addStock($stock);
       
        $this->mDB->addStock($stock, $this->portfolioId);


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
        $isFirstLine = TRUE;
        //getting csv and put that into array
        if(($csv_reader = fopen($filePath, 'r')) !== FALSE) {
            //read line by line
            //data is array that contains all elements in a row.
            while(($data = fgetcsv($csv_reader, 1000, ',')) !== FALSE)  {
                $numElementInRow = count($data); //number of element in a row

        
                $ticker = $data[0];
                $boughtDate = $data[1];
                $boughtPrice = $data[2];
                $numberShares = $data[3];

                //error checking if ticker is in the API
                //if not, just don't add it and don't add up to the new balance
                //syntax for stock -> Stock($name, $symbol, $closingPrice, $quantity)
                if($isFirstLine == FLASE) { //ignore first line since first row is not actaul data.
                    $stock = new Stock($ticker, $ticker, $boughtPrice, $numberShares);
                    $newStockList[$index] = $stock;
                    //calculating new balnce for newPortfolio
                    $newBalance += $boughtPrice * $numberShares;
                    $index++;
                }
                $isFirstLine = FALSE;
            }
            fclose($csv_reader);
        }
 
        $newPortfolio = new Portfolio($this->getWatchList(), $newBalance, $this->getNetPortfolioValue(), $newStockList);
        $mPortfolio = $newPortfolio;
        
        $this->savePortfolio();
    }


}
?>