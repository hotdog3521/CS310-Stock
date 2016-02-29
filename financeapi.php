<?php
ini_set('display_errors', 'on');
$filepath = realpath (dirname(__FILE__));

include($filepath.'/YahooFinanceApi/ApiClient.php');

$client = new YahooFinanceApi\ApiClient();

include($filepath.'/php_classes/APIManager.php');
$mAPI = new APIManager();
$myArray = $mAPI->getStockInfo('GOOGL');
print $myArray['price'];


//Fetch basic data
/*
$data = $client->getQuotesList("YHOO"); //Single stock
$file = "YHOO.json";
$json = json_encode($data);
$jsonS = json_decode($json);
print "Symbol: " . (string)($jsonS->query->results->quote->symbol) . "<br>";
print "Price: " . (string)($jsonS->query->results->quote->LastTradePriceOnly) . "<br>";
print "Date: " . (string)($jsonS->query->results->quote->LastTradeDate) . "<br>";
print "Time: " . (string)($jsonS->query->results->quote->LastTradeTime) . "<br>";

$date1 = new DateTime('2014-05-14');
$date2 = new DateTime('2014-05-16');

$data = $client->getHistoricalData("YHOO", $date1, $date2);


file_put_contents($file, json_encode($data));

*/

/*

$json = json_encode($data);
$jsonS = json_decode($json);
print "Symbol: " . (string)($jsonS->query->results->quote->symbol) . "<br>";
print "Price: " . (string)($jsonS->query->results->quote->LastTradePriceOnly) . "<br>";
print "Date: " . (string)($jsonS->query->results->quote->LastTradeDate) . "<br>";
print "Time: " . (string)($jsonS->query->results->quote->LastTradeTime) . "<br>";
*/

//file_put_contents($file, json_encode($data));

/*

$data = $client->getQuotesList(array("YHOO", "GOOG")); //Multiple stocks at once

//Fetch full data set
$data = $client->getQuotes("YHOO"); //Single stock

$data = $client->getQuotes(array("YHOO", "GOOG")); //Multiple stocks at once



//Get historical data
//$data = $client->getHistoricalData("YHOO");

//Search stocks
$data = $client->search("Yahoo");


JSON output

{
   "query":{
      "count":1,
      "created":"2016-02-27T18:52:24Z",
      "lang":"en-US",
      "results":{
         "quote":{
            "symbol":"YHOO",
            "Symbol":"YHOO",
            "LastTradePriceOnly":"31.37",
            "LastTradeDate":"2\/26\/2016",
            "LastTradeTime":"4:00pm",
            "Change":"+0.01",
            "Open":"31.68",
            "DaysHigh":"31.90",
            "DaysLow":"31.22",
            "Volume":"16683541"
         }
      }
   }
}


$filepath = realpath (dirname(__FILE__));

include($filepath.'/API/client.php');

$client = new client();

$data = $client->getStock('YHOO');
$json = json_encode($data);
print $json;



*/


?>
