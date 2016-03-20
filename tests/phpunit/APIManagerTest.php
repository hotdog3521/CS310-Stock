<?php 
	require_once 'php_classes/APIManager.php';
	class APIManagerTest extends PHPUnit_Framework_TestCase {
		
		public $correctTickerNames=array("GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $correctMarketNames=array("NASDAQ","NASDAQ","NYSE", "NYSE" , "NASDAQ", "NYSE", "NASDAQ", "NASDAQ", "NYSE","NYSE");
		public $correctCountOfResult=4;
		public $validStockList=array("INTC","NVDA","CVS","GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $invalidStockList=array("AAA","ABBBB","NZK","DFDF","KKK","DNUT", "DORETS", "BNGD","KBSCF","DZRS");
	
		//Tests the stockinfo function
		public function testStockSingleInfo(){
			$a = new APIManager();
			$b= $a->getStockInfo("GOOGL");
			$this->assertEquals("GOOGL",$b["symbol"]);
			$this->assertEquals("NASDAQ",$b["market"]);
			$this->assertEquals(4,count($b));
		}

		public function testMultipleStockInfo(){
			$a= new APIManager();
			for ($x=0; $x<count($this->correctTickerNames);$x++){
				$name=$this->correctTickerNames[$x];
				$b= $a->getStockInfo($name);
				$this->assertEquals($this->correctTickerNames[$x],$b["symbol"]);
				$this->assertEquals($this->correctMarketNames[$x],$b["market"]);
				$this->assertEquals($this->correctCountOfResult,count($b));
			}
		}
		//NOW TESTS THE IS STOCK FUNCTION
		public function testCorrectIsStockSingle(){
			$a= new APIManager();
			$this->assertEquals(True,$a->isStock($this->validStockList[0]));
		}

		public function testIncorrectIsStockSingle(){
			$a= new APIManager();
			$this->assertEquals(False,$a->isStock($this->invalidStockList[0]));
		}

		public function testCorrectIsStockMultiple(){
			$a= new APIManager();
			for($x=0; $x<count($this->validStockList); $x++){
				$this->assertEquals(True,$a->isStock($this->validStockList[$x]));
			}
		}

		public function testIncorrectIsStockMultiple(){
			$a= new APIManager();
			for($x=0; $x<count($this->invalidStockList); $x++){
				$this->assertEquals(False,$a->isStock($this->invalidStockList[$x]));
			}

		}

	
	}

?>
