<?php
include 'APIManager.php';
include 'Stock.php';

class MainGraph
{
    // property declaration
    private $mAPI;        //APIManager
    private $timeSetting;       // string literal of time range selection: "1day", "5days", "1month", "6months", "alltime"
    private $mStockList = array(
            //array of stock
    );
    private $mWatchList = array(
            //array of stock
    );

    public function __construct($mAPI, $stockList, $watchList) {
        //constructor
        $this->mAPI = $mAPI;
        $this->mStockList = $stockList;
        $this->mWatchList = $watchList;
        $timeSetting = "6months";

    }

    // method declaration
    public function displayPortfolio( ) {
        //displays a graph of aggregate portfolio value over time
    }

    public function displaySingleGraph( $Stock ) {
        //displays a graph of selected stock and its price over time
    }

    public function displayWatchList() {
        //displays the graph of all the visible stock in the watchlist.
    }


    public function setTimeFrame($timeSetting) {
        //changes the the range of the X-axis and sets the time frame to the selected time
        $this->timeSetting = $timeSetting;
    }

    public function setStockList($stockList) {
        //sets the $stockList parameter to the passed in variable

        $this->mStockList = $stockList;
    }

    public function setWatchList($watchList) {
        //sets the $watchList parameter to the passed in variable

        $this->mWatchList = $watchList;
    }

}
?>