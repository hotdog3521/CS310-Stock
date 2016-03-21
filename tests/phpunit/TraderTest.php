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
	
		//Test the isStock function on a valid stock
		public function testCorrectIsStock(){
				//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$c= new Trader($a, $b);
			for($x=0; $x<count($this->validStockList); $x++){			
				//ACT
				$d=$c->isStock($this->validStockList[$x]);
				//ASSERT
				$this->assertEquals(True,$d);
			}
		}
		//Tests isStock function on an invalid stock
		public function testIncorrectIsStock(){
			//Arrange
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$c= new Trader($a, $b);
			for($x=0; $x<count($this->invalidStockList); $x++){				
				//ACT
				$d=$c->isStock($this->invalidStockList[$x]);
				//ASSERT
				$this->assertEquals(False,$d);
			}

		}

		//Test the canBuy function where cost < ballance
		public function testCorrectCanBuyWithSurplusMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(2000);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result = $c->canBuy($stock,1);
			//ASSERT
			$this->assertEquals(True,$result);

		}


		//Test the canBuy function where cost = ballance
		public function testCorrectCanBuyWithEqualMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(100);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result = $c->canBuy($stock,1);
			//ASSERT
			$this->assertEquals(True,$result);

		}

		//Test the canBuy function where ccost =ballange+1 (therefore not within budget)
		public function testIncorrectCanBuyWithOneShortMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(99);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result = $c->canBuy($stock,1);
			//ASSERT
			$this->assertEquals(false,$result);
		}
		//Test the canbuy function where cost > ballances
		public function testIncorrectCanBuyWithOneALotShortMoney(){
			//ARRANGE
			$a= new APIManager();
			$b= new PortfolioManager(14);
			$b->setBalance(9);
			$c= new Trader($a, $b);
			$stock = new Stock("Google","GOOGL",100,10,9);
			//ACT 
			$result = $c->canBuy($stock, 10);
			//ASSERT
			$this->assertEquals(false,$result);
		}

	}

?>
