<?php

	require_once 'php_classes/PortfolioManager.php';

	class PortfolioManagerTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		public function testGetZeroBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL,0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		public function testGetPositiveBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(3, $pm->getBalance());
		}

		public function testSetNegativeBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(-1);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

		public function testSetZeroBalance(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			// Act
			$pm->setBalance(0);
			// Assert
			$this->assertEquals(0, $pm->getBalance());
		}

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

		public function testGetZeroNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		public function testGetPositiveNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 5, NULL);
			// Act
			// Assert
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}

		public function testSetNegativeNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			// Act
			$pm->setBalance(-1);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		public function testSetZeroNetPortfolioValue(){
			// Arrange
			$pm = new PortfolioManager(14);
			$pm->loadNewPortfolio(NULL, 0, 3, NULL);
			// Act
			$pm->setBalance(0);
			// Assert
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

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