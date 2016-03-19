<?php 
	require_once 'php_classes/APIManager.php';
	class APIManagerTest extends PHPUnit_Framework_TestCase {
		// public function testTrial(){
		// 	$a = new APIManager();
		public $correctTickerNames=array("GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $correctMarketNames=array("NASDAQ","NASDAQ","NYSE", "NYSE" , "NKE", "NASDAQ", "NASDAQ", "NYSE", "NYSE");
		public $correctCountOfResult=4;
		// 	this->assertEquals("trial name",$a->getName());
		// }
		//Tests the name
		public function testStockSingle(){
			$a = new APIManager();
			$b= $a->getStockInfo("GOOGL");
			$this->assertEquals("GOOGL",$b[0]);
			$this->assertEquals("GOOGL",$b[1]);
			$this->assertEquals(4,count($b));
		}

		public function testMultipleStockTickerSymbols(){
			$a= new APIManager();
			for ($x=0; $x<count($correctTickerNames);$x++){
				$b= $a->getStock($correctTickerNames[x]);
				$this->assertEquals($correctTickerNames[x],$b[0]);
				$this->assertEquals($correctMarketNames[x],$b[1]);
				$this->assertEquals($correctCountOfResult,count($b));
			}
		}
		//NOW TESTS THE IS STOCK FUNCTION
		public function testIsStockSingle(){

		}

		public function testIsStockMultiple(){
			
		}


	
	}

?>
