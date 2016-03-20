<?php

	require_once 'php_classes/Portfolio.php';
	require_once 'php_classes/Stock.php';

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
			// Assert
			$this->assertEquals(1, sizeof($list2));
			$this->assertEquals("bar", $list2["foo"]);
		}

		public function testAddNewToWatchList(){
			// Arrange
			$list = array();
			$p = new Portfolio($list, 0, 0, NULL);
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			// Act
			$p->addToWatchList($stock);
			$list2 = $p->getWatchList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
			$this->assertEquals("Apple", $list2["Apple"]->getName());
		}

		public function testAddDuplicateToWatchList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			$p->addToWatchList($stock);
			$list2 = $p->getWatchList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
		}

		public function testRemoveExistentFromWatchList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			$p->removeFromWatchList($stock);
			$list2 = $p->getWatchList();
			// Assert
			$this->assertEquals(0, sizeof($list2));
		}

		public function testRemoveNonexistentFromWatchList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$stock2 = new Stock("Microsoft", "MSFT", 0 ,0 ,0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			$p->removeFromWatchList($stock2);
			$list2 = $p->getWatchList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
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

		public function testAddNewToStockList(){
			// Arrange
			$list = array();
			$p = new Portfolio(NULL, 0, 0, $list);
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			// Act
			$p->addStock($stock);
			$list2 = $p->getStockList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
			$this->assertEquals("Apple", $list2["Apple"]->getName());
		}

		public function testAddDuplicateToStockList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			$p->addStock($stock);
			$list2 = $p->getStockList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
		}

		public function testRemoveExistentFromStockList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			$p->removeStock($stock);
			$list2 = $p->getStockList();
			// Assert
			$this->assertEquals(0, sizeof($list2));
		}

		public function testRemoveNonexistentFromStockList(){
			// Arrange
			$stock = new Stock("Apple", "AAPL", 0, 0, 0);
			$stock2 = new Stock("Microsoft", "MSFT", 0 ,0 ,0);
			$list = array(
				"Apple" => $stock);
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			$p->removeStock($stock2);
			$list2 = $p->getStockList();
			// Assert
			$this->assertEquals(1, sizeof($list2));
		}
	}

?>