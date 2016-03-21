<?php 
	require_once 'php_classes/APIManager.php';
	class APIManagerTest extends PHPUnit_Framework_TestCase {
		//ARRANGE
		public $correctTickerNames=array("GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $correctMarketNames=array("NASDAQ","NASDAQ","NYSE", "NYSE" , "NASDAQ", "NYSE", "NASDAQ", "NASDAQ", "NYSE","NYSE");
		public $correctCountOfResult=4;
		public $validStockList=array("INTC","NVDA","CVS","GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $invalidStockList=array("AAA","ABBBB","NZK","DFDF","KKK","DNUT", "DORETS", "BNGD","KBSCF","DZRS");
	
		//Tests the stockinfo function for a valid stock
		public function testStockSingleInfo(){
			//ARRANGE
			$a = new APIManager();
			//ACT
			$b= $a->getStockInfo("GOOGL");
			//RESULT
			$this->assertEquals("GOOGL",$b["symbol"]);
			$this->assertEquals("NASDAQ",$b["market"]);
			$this->assertEquals(4,count($b));
		}
		//Tests the stockinfo funciton for multiple valid stock
		public function testMultipleStockInfo(){
			//ARRANGE
			$a= new APIManager();
			for ($x=0; $x<count($this->correctTickerNames);$x++){
				$name=$this->correctTickerNames[$x];
				//ACT				
				$b= $a->getStockInfo($name);
				//RESULT				
				$this->assertEquals($this->correctTickerNames[$x],$b["symbol"]);
				$this->assertEquals($this->correctMarketNames[$x],$b["market"]);
				$this->assertEquals($this->correctCountOfResult,count($b));
			}
		}
		//NOW TESTS THE IS STOCK FUNCTION
		//Tests the isStock function for a valid stock
		public function testCorrectIsStockSingle(){
			//ARRANGE
			$a= new APIManager();
			//ACT			
			$b=$a->isStock($this->validStockList[0]);
			//RESULT			
			$this->assertEquals(True,$b);
		}
		//Tests the isStock function for an invalid stock
		public function testIncorrectIsStockSingle(){
			//ARRANGE
			$a= new APIManager();
			//ACT		
			$b=$a->isStock($this->invalidStockList[0]);
			//RESULT
			$this->assertEquals(False,$b);
		}
		//Tests the isStock function for multiple valid stocks
		public function testCorrectIsStockMultiple(){
			//ARRANGE
			$a= new APIManager();
			for($x=0; $x<count($this->validStockList); $x++){			
				//ACT
				$b=$a->isStock($this->validStockList[$x]);
				//RESULT
				$this->assertEquals(True,$b);
			}
		}
		//Tests the isStock fucntion for multiple invalid stocks
		public function testIncorrectIsStockMultiple(){
			//ARRANGE
			$a= new APIManager();
			for($x=0; $x<count($this->invalidStockList); $x++){				
				//ACT
				$b=$a->isStock($this->invalidStockList[$x]);
				//RESULT
				$this->assertEquals(False,$b);
			}

		}

	
	}

?>
