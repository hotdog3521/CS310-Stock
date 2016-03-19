<?php
	//namespace phpunit; 
	require_once 'php_classes/Stock.php';
	class StockTest extends PHPUnit_Framework_TestCase {
		public function testTrial(){
			$a = new Stock("trial name","TST",11,10,9);
			$this->assertEquals("trial name",$a->getName());
		}
		//Tests the name
		public function testName(){
			$a = new Stock("Johnny","TST",11,10,9);
			$this->assertEquals("Johnny",$a->getName());
		}
		//Tests concatenated name
		public function testNameConcatination(){
			$a = new Stock("Johnny"." Wood " ."1","TST",11,10,9);
			$this->assertEquals("Johnny Wood 1",$a->getName());
		}
		public function testChangName()
		{
			$a = new Stock("Johnny Wood","TST",11,10,9);
			$this->assertEquals("Johnny Wood",$a->getName());
			$a->setName("New Johnny");
			$this->assertEquals("New Johnny",$a->getName());
		}	
		//I DONT KNOW IF I CAN DO THIS
		public function testIfNameTakesNumbers(){
			$a = new Stock(1,"TST",11,10,9);
			$this->assertEquals(1,$a->getName());
		}

		public function testIfNameTakesCharacters(){
			$a = new Stock("qwerty12345!@#$%<>?","TST",12,12,12);
			$this->assertEquals("qwerty12345!@#$%<>?",$a->getName());
		}


		//NOW TESTING CLOSING PRICE FUNCTIONALITYY

		public function testClosingPrice() {
			$a = new Stock("Johnny","TST",10,12,12);
			$this->assertEquals(10.0,$a->getClosingPrice());
		}
		public function testChangingClosingPrice(){
			$a = new Stock("Johnny","TST",10,12,12);
			$this->assertEquals(10.0,$a->getClosingPrice());
			$a->setClosingPrice(24);
			$this->assertEquals(24.0,$a->getClosingPrice());
		}
		public function testNegativePrices(){
			$a = new Stock("Johnny","TST",-10,12,12);
			$this->assertEquals(0.0,$a->getClosingPrice());

		}
		public function testChangeToNegativePrice(){
			$a = new Stock("Johnny","TST",10,12,12);
			$this->assertEquals(10.0,$a->getClosingPrice());
			$a->setClosingPrice(-10);
			$this->assertEquals(0.0,$a->getClosingPrice());
		}
		public function testFactionClosingPrices(){
			$a = new Stock("Johnny", "TST", 10.55,12,12);
			$this->assertEquals(10.55,$a->getClosingPrice());
		}	
		public function testNegativeFractionClosingPrice(){
			$a = new Stock("Johnny","TST",-12.55,12,12);
			$this->assertEquals(0.0,$a->getClosingPrice());
		}
		public function testRoundOfClosingPrice(){
			$a = new Stock("Johnny","TST",12.9899,10,10);
			$this->assertEquals(12.99,$a->getClosingPrice());
		}
		public function testNegativeRoundOfClosingPrice(){
			$a = new Stock("Johnny","TST",-12.9899,10,10);
			$this->assertEquals(0.0,$a->getClosingPrice());
		}
	}

?>
