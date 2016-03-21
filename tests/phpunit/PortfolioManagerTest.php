<?php

	require_once 'php_classes/PortfolioManager.php';

	class PortfolioManagerTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		// Tests getBalance() function for balance = 10000
		public function testGetBalance(){
			// Arrange
			$pm = new PortfolioManager(12);
			// Act
			// Assert
			$this->assertEquals(10000, $pm->getBalance());
		}

		// Tests setBalance() function for balance < 0
		// Expected to set balance to 0
		public function testSetNegativeBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			// Act
			$pm->setBalance(-1);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		// Tests setBalance() function for balance = 0
		public function testSetZeroBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			// Act
			$pm->setBalance(0);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		// Tests setBalance() function for balance set to >0
		public function testSetPositiveBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
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
			// Act
			$pm->setNetPortfolioValue(-1);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue for new value = 0
		public function testSetZeroNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			// Act
			$pm->setNetPortfolioValue(0);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		// Tests setNetPortfolioValue for value > 0
		public function testSetPositiveNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			// Act
			$pm->setNetPortfolioValue(5);
			// Assert
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}
	}

?>