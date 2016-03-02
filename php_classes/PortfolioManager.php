<?php
include 'Portfolio.php';
include 'Stock.php';
include 'DBManager.php';
ini_set("display_errors", "on");

class PortfolioManager
{
    // property declaration

    private $mDB;
    private $mAPI; 
    private $mPortfolio; 
    private $mVisibleStocks = array();
    private $userId;
    private $portfolioId;
    private $watchListId;

    // constructor that takes in a user ID and uses the database to populate the rest of the portfolio Data
    public function __construct($id)
    {
        $this->mDB = new DBManager();
        $this->userId = $id;
        $this->portfolioId = $this->mDB->getPortfolioId($id);
        $this->watchListId = $this->mDB->getWatchListId($id);

    }

    //return array of stock mVisibleStocks
    public function getVisibleStocks($stockPrefix) {

        return $this->mVisibleStocks;
    }

    // set the balance of the portfolio
    public function setBalance($balance) {

        $this->mPortfolio->setBalance($balance);
    }

    // return the balance of the portfolio
    public function getBalance() {

        return $this->mDB->getAccountBalance($this->userId);
    }

    //returns portfolio’s net value
    public function getNetPortfolioValue(){

        return $this->mPortfolio->getNetPortfolioValue();
    }

    // return the Portfolio List
    public function getStockList() {

        return $this->mDB->getPortfolio($this->userId);
    }

    //calls the addStock method in $mPortfolio
    public function addStock($stock) {
       
        $this->mDB->addStock($stock, $this->portfolioId, $this->userId);


    }

    // removes a stock from Portfolio List in Portfolio
    public function removeStock($stock) {
        //calls the removeStock method $mPortfolio

        $this->mPortfolio ->removeStock($stock);

        // update the database as well
        $this->mDB->removeFromPortfolioList($this->portfolio_id, $stock);
    }

    // returns the Watchlist in Portfolio
    public function getWatchList() {
        //calls the getWatchList function in $mPortfolio 

        return $this->mDB->getWatchList($this->userId);
    }

    // adds a stock from the Watchlist in Portfolio
    public function addWatchListStock($stock) {
        //calls the addWatchListStock function in $mPortfolio

        // update the database as well

        $this->mDB->addWatchListStock($stock, $this->watchListId);
    }

    // remove a stock from the Watchlist in Portfolio
    public function removeFromWatchList($stock) {
        //calls the removeFromWatchList function in $mPortfolio
        $this->mPortfolio->removeFromWatchList($stock);
        // update the database as well
        $this->mDB->removeFromWatchList($this->watchListId, $stock);
    }

    // should take the current Portfolio stored in $mPortfolio, and update the MySQL tables according to its info
    public function savePortfolio(){
        
    }

    // upload a CSV to be a new portfolio
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

        $balance = $this->mDB->getBalance($userId);

        $this->mPortfolio = new Portfolio($watchlistStocks, $balance, 0, $portfolioStocks);
    }


}
?>