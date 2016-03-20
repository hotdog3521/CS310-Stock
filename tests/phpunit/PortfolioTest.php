<?php

	require_once 'php_classes/Portfolio.php';
	//require_once 'php_classes/Stock.php';

	class PortfolioTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		// Tests getBalance() function for balance values of 0
		public function testGetZeroBalance(){

			// Arrange
			$p = new Portfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		// Tests getBalance() function for balance values > 0
		public function testGetPositiveBalance(){
			// Arrange
			$p = new Portfolio(NULL, 3, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $p->getBalance());
		}

		// Tests setBalance() function for a new value < 0
		// Expected to set balance to 0 since negative balance is not possible
		public function testSetNegativeBalance(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setBalance(-1);
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		// Tests setBalance() function for a new value = 0
		public function testSetZeroBalance(){
			// Arrange
			$p = new Portfolio(NULL,-1, 0, NULL);
			// Act
			$p->setBalance(0);
			// Assert
			$this->assertEquals(0, $p->getBalance());
		}

		// Tests setBalance() function for a new value > 0
		public function testSetPositiveBalance(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setBalance(5);
			// Assert
			$this->assertEquals(5, $p->getBalance());
		}

		// testing functions using $netPortfolioValue

		// Tests getNetPortflioValue() for value = 0
		public function testGetZeroNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		// Tests getNetPortfolioValue() for value > 0
		public function testGetPositiveNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL, 0, 3, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $p->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue() for value < 0
		// Expected to set value to 0 since negative net portfolio value not possible
		public function testSetNegativeNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setNetPortfolioValue(-1);
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue() for value = 0
		public function testSetZeroNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,-1, 0, NULL);
			// Act
			$p->setNetPortfolioValue(0);
			// Assert
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		// Tests setNetPortfolioVAlue() for value > 0
		public function testSetPositiveNetPortfolioValue(){
			// Arrange
			$p = new Portfolio(NULL,0, 0, NULL);
			// Act
			$p->setNetPortfolioValue(5);
			// Assert
			$this->assertEquals(5, $p->getNetPortfolioValue());
		}

		// testing functions using $mWatchlist

		// test getWatchList() for empty watchlists
		public function testGetEmptyWatchList(){
			// Arrange
			$list = array();
			$p = new Portfolio($list, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, sizeof($p->getWatchList()));
		}

		// tests getWatchList() for nonempty watchlists
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

		// tests addToWatchList() for a new Stock to be added
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

		// Tests addToWatchList() for a duplicate Stock already in the list
		// Expected to not change the watchlist
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

		// Tests removeFromWatchList() for an existing Stock in the list
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

		// Tests removeFromWatchList() for a nonexistent Stock in the list
		// Expected to not change the list
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

		// Tests getStockList() for an empty list
		public function testGetEmptyStockList(){
			// Arrange
			$list = array();
			$p = new Portfolio(NULL, 0, 0, $list);
			// Act
			// Assert
			$this->assertEquals(0, sizeof($p->getStockList()));
		}

		// Tests getStockList() for a nonempty list
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

		// Tests addStock() for a new Stock into the list
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

		// Tests addStock() for a duplicate Stock into the list
		// Expected to not change the list
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

		// Tests removeStock() for an existing Stock in the list
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

		// Tests removeStock() for a nonexistent Stock in the list
		// Expected not to change the list
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