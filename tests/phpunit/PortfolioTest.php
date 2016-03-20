<?php

	require_once 'php_classes/Portfolio.php';

	class PortfolioTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		public function testGetZeroBalance(){

			// Arrange
			$p = new Portfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		public function testGetPositiveBalance(){
			// Arrange
			$p = new Portfolio(NULL, 3, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $p->getBalance());
		}

		public function testSetNegativeBalance(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setBalance(-1);
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		public function testSetZeroBalance(){
			// Arrange
			$p = new Portfolio(NULL,-1, 0, NULL);
			// Act
			$p->setBalance(0);
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		public function testSetPositiveBalance(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setBalance(5);
			// Assert
			$this->assertEquals(5, $p->getBalance());
		}

		// testing functions using $netPortfolioValue

		public function testGetZeroNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testGetPositiveNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL, 0, 3, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $p->getNetPortfolioValue());
		}

		public function testSetNegativeNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setNetPortfolioValue(-1);
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testSetZeroNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,-1, 0, NULL);
			// Act
			$p->setNetPortfolioValue(0);
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testSetPositiveNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setNetPortfolioValue(5);
			// Assert
			$this->assertEquals(5, $p->getNetPortfolioValue());
		}

		// testing functions using $mWatchlist

		public function testGetEmptyWatchList(){
			// Arrange
			$list = array();
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, sizeof($p->getWatchList()));
		}

		public function testGetNonemptyWatchList(){
			// Arrange
			$list = array(
				"foo" => "bar");
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			$list2 = $p->getWatchList();
			//Assert
			$this->assertEquals(1, sizeof($list2));
			$this->assertEquals("bar", $list2["foo"]);
		}

		// testing functions using $mStockList

		public function testGetEmptyStockList(){
			// Arrange
			$list = array();
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			// Assert
			$this->assertEquals(0, sizeof($p->getStockList()));
		}

		public function testGetNonemptyStockList(){
			// Arrange
			$list = array(
				"foo" => "bar");
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			$list2 = $p->getStockList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
			$this->assertEquals("bar", $list2["foo"]);
		}
	}

?>