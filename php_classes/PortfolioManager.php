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
    private $mVisibleStocks = array(

    );

    private $userId;
    private $portfolioId;
    private $watchListId;

    public function __construct($id)
    {
        $this->mDB = new DBManager();
        $this->userId = $id;
        $this->portfolioId = $this->mDB->getPortfolioId($id);
        $this->watchListId = $this->mDB->getWatchListId($id);

        // $this->mAPI = new APIManager();
    }

    // method declaration
    public function logout() {
        //returns true or false depending on the status of the logout process
        //boolean function
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

        // return $this->mPortfolio->getBalance();

        return $this->mDB->getAccountBalance($this->userId);
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

        // do the same for the database
       
        $this->mDB->addStock($stock, $this->portfolioId, $this->userId);


    }
    public function removeStock($stock) {
        //calls the removeStock method $mPortfolio

        $this->mPortfolio ->removeStock($stock);

        // update the database as well
        $this->mDB->removeFromPortfolioList($this->portfolio_id, $stock);
    }
    public function getWatchList() {
        //calls the getWatchList function in $mPortfolio 

        return $this->mDB->getWatchList($this->userId);
    }
    public function addWatchListStock($stock) {
        //calls the addWatchListStock function in $mPortfolio

        // $this->mPortfolio->addToWatchList($stock);

        // update the database as well

        $this->mDB->addWatchListStock($stock, $this->watchListId);
    }
    public function removeFromWatchList($stock) {
        //calls the removeFromWatchList function in $mPortfolio
        $this->mPortfolio->removeFromWatchList($stock);
        // update the database as well
        $this->mDB->removeFromWatchList($this->watchListId, $stock);
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

    // function to load the portfolio from the database to a new Portfolio object
    public function loadPortfolio(){

        $portfolioStocks = $this->mDB->getPortfolio($userId);
        $watchlistStocks = $this->mDB->getWatchList($userId);

        $this->mPortfolio = new Portfolio($watchlistStocks, 0, 0, $portfolioStocks);
    }


}
?>