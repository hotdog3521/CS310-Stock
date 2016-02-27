<?php
class MainGraph
{
    // property declaration
    private $mAPI;        //APIManager
    private $mStockList = array(
            //array of stock
    );
    private $watchList = array(
            //array of stock
    );

    public function__construct($mAPI, $stockList, $watchList) {
        //constructor
        $this->mAPI = $mAPI;
        $this->mStockList = $mStockList;
        $this->watchList = $watchList;

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


    public function setTimeFrame($time) {
        //changes the the range of the X-axis and sets the time frame to the selected time
    }

    public function setStockList($stockList) {
        //sets the $stockList parameter to the passed in variable
    }

    public function setWatchList($watchList) {
        //sets the $watchList parameter to the passed in variable
    }

}
?>