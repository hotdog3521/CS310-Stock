<?php
	//namespace phpunit; 
	require_once 'php_classes/Stock.php';
	class StockTest extends PHPUnit_Framework_TestCase {
		
		//Tests the getName function
		public function testName(){
			//ARRANGE
			$a = new Stock("Johnny","TST",11,10,9);
			//ACT
			$b=$a->getName();
			//ASSERT
			$this->assertEquals("Johnny",$b);
		}
		//Tests concatenated name passed into the constructor
		public function testNameConcatination(){
			//ARRANGE
			$a = new Stock("Johnny"." Wood " ."1","TST",11,10,9);
			//ACT
			$b=$a->getName();
			//ASSERT
			$this->assertEquals("Johnny Wood 1",$b);
		}


		//Tests the setName function
		public function testChangName()
		{
			//ARRANGE
			$a = new Stock("Johnny Wood","TST",11,10,9);
			//ACT
			$a->setName("New Johnny");
			//ASSERT
			$this->assertEquals("New Johnny",$a->getName());
		}	
		//Tests if constructor accepts characters
		public function testIfNameTakesCharacters(){
			//ARRANGE
			$a = new Stock("qwerty12345!@#$%<>?","TST",12,12,12);
			//ACT
			$b=$a->getName();
			//ASSERT
			$this->assertEquals("qwerty12345!@#$%<>?",$b);
		}

		//NOW TESTING CLOSING PRICE FUNCTIONALITYY
		//Tests getclosingprice()
		public function testClosingPrice() {
			//ARRANGE
			$a = new Stock("Johnny","TST",10,12,12);
			//ACT
			$b=$a->getClosingPrice();
			//ASSERT
			$this->assertEquals(10.0,$b);
		}
		//Tests setClosingPrice()
		public function testChangingClosingPrice(){
			//ARRANGE
			$a = new Stock("Johnny","TST",10,12,12);
			//ACT
			$a->setClosingPrice(24);
			//ASSERT
			$this->assertEquals(24.0,$a->getClosingPrice());
		}
		//Tests if constructor defaults negative prices to 0
		public function testNegativePrices(){
			//ARRANGE
			$a = new Stock("Johnny","TST",-10,12,12);
			//ACT
			$b=$a->getClosingPrice();
			//ASSERT
			$this->assertEquals(0.0,$b);
		}
		//Tests if setClosingPrice defaults negative prices to 0
		public function testChangeToNegativePrice(){
			//ARRANGE
			$a = new Stock("Johnny","TST",10,12,12);
			//ACT
			$a->setClosingPrice(-10);
			//ASSERT
			$this->assertEquals(0.0,$a->getClosingPrice());
		}
		//Tests if constructor takes in rational numbers 
		public function testFactionClosingPrices(){
			//ARRANGE
			$a = new Stock("Johnny", "TST", 10.55,12,12);
			//ACT
			$b=$a->getClosingPrice();
			//ASSERT
			$this->assertEquals(10.55,$b);
		}	
		//Tests if constructor defauls a negative rational number to 0
		public function testNegativeFractionClosingPrice(){
			//ARRANGE
			$a = new Stock("Johnny","TST",-12.55,12,12);
			//ACT
			$b= $a->getClosingPrice();
			//ASSERT
			$this->assertEquals(0.0,$b);
		}
		//Tests if rationional numbers are rounded up to two decimal places
		public function testRoundOfClosingPrice(){
			//ARRANGE
			$a = new Stock("Johnny","TST",12.9899,10,10);
			//ACT
			$b=$a->getClosingPrice();
			//ASSERT
			$this->assertEquals(12.99,$b);
		}
		//Tests if negative rational numbers with more than 2 decimal places default to 0
		public function testNegativeRoundOfClosingPrice(){
			//ARRANGE
			$a = new Stock("Johnny","TST",-12.9899,10,10);
			//ACT
			$b=$a->getClosingPrice();
			//ASSERT
			$this->assertEquals(0.0,$b);
		}
		// Tests getting and setting sysmbol
		public function testChangeSymbol(){
			//ARRANGE
			$a = new Stock("Johnny", "TST", -121,19, 19);
			//ACT
			$a->setSymbol("JOH");

			//ASSERT
			$this->assertEquals("JOH",$a->getSymbol());
		}
		// Tests getting and setting quantity
		public function testChangeQuantity(){
			//ARRANGE
			$a = new Stock("Johnny", "TST", -121,19, 19);
			//ACT
			$a->setQuantity(1000);

			//ASSERT
			$this->assertEquals(1000,$a->getQuantity());
		}
	}

?>
