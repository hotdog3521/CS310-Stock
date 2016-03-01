<?php

$filepath = realpath (dirname(__FILE__));
include(dirname($filepath) . '/API/client.php');


class APIManager
{

    // property declaration
    private $client;
    private $mDB;
    // method declaration
    public function __construct() {
        $this->client = new client();

    }
    public function getStockInfo($companyName) {
    	//Given a company name in String form, this function queries the finance API and returns the stock’s information
     $quote = $this->client->getStock($companyName); //Single stock
      return $quote;
      // json format:
      /*
        {
         "id":"694653",
         "t":"GOOGL",
         "e":"NASDAQ",
         "l":"724.86",
         "l_fix":"724.86",
         "l_cur":"724.86",
         "s":"0",
         "ltt":"4:00PM EST",
         "lt":"Feb 26, 4:00PM EST",
         "lt_dts":"2016-02-26T16:00:01Z",
         "c":"-4.26",
         "c_fix":"-4.26",
         "cp":"-0.58",
         "cp_fix":"-0.58",
         "ccol":"chr",
         "pcls_fix":"729.12"
      }

      */


    }
    public function getStocksStartingWith($stockPrefix) {
    	//Given a String input, this function returns an array of stocks with matching characters as the inputted string.
        // query SQL server using LIKE
        // return array of answers

        return $array;
    }

    public function isStock($companyName){ // returns 1 if stock exists, 0 otherwise
      //Given a compnay name in String form, this function queries the finance API and returns if the stock exists
      $quote = $this->client->getStock($companyName); //Single stock
       return $quote!=0;
    }


}
?>
