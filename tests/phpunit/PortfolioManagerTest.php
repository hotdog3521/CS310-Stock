<?php

	require_once 'php_classes/PortfolioManager.php';

	class PortfolioManagerTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		// Tests getBalance() function for balance = 0
		public function testGetZeroBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL,0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		// Tests getBalance() function for balance > 0
		public function testGetPositiveBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $pm->getBalance());
		}

		// Tests setBalance() function for balance < 0
		// Expected to set balance to 0
		public function testSetNegativeBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(-1);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		// Tests setBalance() function for balance = 0
		public function testSetZeroBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			// Act
			$pm->setBalance(0);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		// Tests setBalance() function for balance set to >0
		public function testSetPositiveBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(5);
			// Assert
			$this->assertEquals(5, $pm->getBalance());
		}

		// testing functions using $netPortfolioValue

		// Tests getNetPortfolioValue for value = 0
		public function testGetZeroNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		// Tests getNetPortfolioValue for value > 0
		public function testGetPositiveNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 5, NULL);
			// Act
			// Assert
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue for new value < 0
		// Expected to set the value to 0
		public function testSetNegativeNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(-1);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue for new value = 0
		public function testSetZeroNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 3, NULL);
			// Act
			$pm->setBalance(0);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue for value > 0
		public function testSetPositiveNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(5);
			// Assert
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}
	}

?>