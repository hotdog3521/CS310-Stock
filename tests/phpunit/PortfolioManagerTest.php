<?php

	require_once 'php_classes/PortfolioManager.php';

	class PortfolioManagerTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		public function testGetZeroBalance(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$this->assertEquals(0, $pm->getBalance());
		}

		public function testGetPositiveBalance(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			$this->assertEquals(3, $pm->getBalance());
		}

		public function testSetNegativeBalance(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$pm->setBalance(-1);
			$this->assertEquals(0, $pm->getBalance());
		}

		public function testSetZeroBalance(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 3, 0, NULL);
			$pm->setBalance(0);
			$this->assertEquals(0, $pm->getBalance());
		}

		public function testSetPositiveBalance(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$pm->setBalance(5);
			$this->assertEquals(5, $pm->getBalance());
		}

		// testing functions using $netPortfolioValue

		public function testGetZeroNetPortfolioValue(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		public function testGetPositiveNetPortfolioValue(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 5, NULL);
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}

		public function testSetNegativeNetPortfolioValue(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$pm->setBalance(-1);
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		public function testSetZeroNetPortfolioValue(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 3, NULL);
			$pm->setBalance(0);
			$this->assertEquals(0, $pm->getNetPortfolioValue());
		}

		public function testSetPositiveNetPortfolioValue(){
			$pm = new PortfolioManager(0);
			$pm->loadNewPortfolio(NULL, 0, 0, NULL);
			$pm->setBalance(5);
			$this->assertEquals(5, $pm->getNetPortfolioValue());
		}
	}

?>