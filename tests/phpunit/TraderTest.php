<?php 
	require_once 'php_classes/APIManager.php';
	require_once 'php_classes/PortfolioManager.php';
	require_once 'php_classes/Trader.php';
	class TraderTest extends PHPUnit_Framework_TestCase {
		//ARRANGE
		public $correctTickerNames=array("GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $correctMarketNames=array("NASDAQ","NASDAQ","NYSE", "NYSE" , "NASDAQ", "NYSE", "NASDAQ", "NASDAQ", "NYSE","NYSE");
		public $correctCountOfResult=4;
		public $validStockList=array("INTC","NVDA","CVS","GOOGL","AAPL","MMM","IBM","MSFT","NKE", "AMZN", "YHOO", "KO" ,"HPQ");
		public $invalidStockList=array("AAA","ABBBB","NZK","DFDF","KKK","DNUT", "DORETS", "BNGD","KBSCF","DZRS");
	
		//Test the isStock function
		public function testCorrectIsStock(){
				//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$c= new Trader($a, $b);
			for($x=0; $x<count($this->validStockList); $x++){			
				//ACT
				$d=$c->isStock($this->validStockList[$x]);
				//RESULT
				$this->assertEquals(True,$d);
			}
		}

		public function testIncorrectIsStock(){
			//Arrange
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$c= new Trader($a, $b);
			for($x=0; $x<count($this->invalidStockList); $x++){				
				//ACT
				$d=$c->isStock($this->invalidStockList[$x]);
				//RESULT
				$this->assertEquals(False,$d);
			}

		}

		//Test the canBuy function
		public function testCorrectCanBuyWithSurplusMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(2000);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result->canBuy($stock,1);
			//RESULT
			$this->assertEquals(True,$result);

		}


		//Test the canBuy function
		public function testCorrectCanBuyWithEqualMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(100);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result->canBuy($stock,1);
			//RESULT
			$this->assertEquals(True,$result);

		}
		public function testIncorrectCanBuyWithOneShortMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(99);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result->canBuy($stock,1);
			//RESULT
			$this->assertEquals(false,$result);
		}
		public function testIncorrectCanBuyWithOneALotShortMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(9);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result->canBuy($stock, 10);
			//RESULT
			$this->assertEquals(false,$result);
		}

	}

?>
