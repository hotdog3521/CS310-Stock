<?php 
	require_once 'php_classes/APIManager.php';
	require_once 'php_classes/PortfolioManager.php';
	require_once 'php_classes/Trader.php';
	class TraderTest extends PHPUnit_Framework_TestCase {
		
		public $correctTickerNames=array("GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $correctMarketNames=array("NASDAQ","NASDAQ","NYSE", "NYSE" , "NASDAQ", "NYSE", "NASDAQ", "NASDAQ", "NYSE","NYSE");
		public $correctCountOfResult=4;
		public $validStockList=array("INTC","NVDA","CVS","GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $invalidStockList=array("AAA","ABBBB","NZK","DFDF","KKK","DNUT", "DORETS", "BNGD","KBSCF","DZRS");
	
		//Tests the stockinfo function

	
	}

?>
