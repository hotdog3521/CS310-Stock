<?php

	require_once 'php_classes/Portfolio.php';

	class PortfolioTest extends PHPUnit_Framework_TestCase {

		// testing functions using $balance

		public function testGetZeroBalance(){
			$p = new Portfolio(NULL, 0, 0, NULL);
			$this->assertEquals(0, $p->getBalance());
		}

		public function testGetPositiveBalance(){
			$p = new Portfolio(NULL, 3, 0, NULL);
			$this->assertEquals(3, $p->getBalance());
		}

		public function testSetNegativeBalance(){
			$p = new Portfolio(NULL,0, 0, NULL);
			$p->setBalance(-1);
			$this->assertEquals(0, $p->getBalance());
		}

		public function testSetZeroBalance(){
			$p = new Portfolio(NULL,-1, 0, NULL);
			$p->setBalance(0);
			$this->assertEquals(0, $p->getBalance());
		}

		public function testSetPositiveBalance(){
			$p = new Portfolio(NULL,0, 0, NULL);
			$p->setBalance(5);
			$this->assertEquals(5, $p->getBalance());
		}

		// testing functions using $netPortfolioValue

		public function testGetZeroNetPortfolioValue(){
			$p = new Portfolio(NULL, 0, 0, NULL);
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testGetPositiveNetPortfolioValue(){
			$p = new Portfolio(NULL, 0, 3, NULL);
			$this->assertEquals(3, $p->getNetPortfolioValue());
		}

		public function testSetNegativeNetPortfolioValue(){
			$p = new Portfolio(NULL,0, 0, NULL);
			$p->setNetPortfolioValue(-1);
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testSetZeroNetPortfolioValue(){
			$p = new Portfolio(NULL,-1, 0, NULL);
			$p->setNetPortfolioValue(0);
			$this->assertEquals(0, $p->getNetPortfolioValue());
		}

		public function testSetPositiveNetPortfolioValue(){
			$p = new Portfolio(NULL,0, 0, NULL);
			$p->setNetPortfolioValue(5);
			$this->assertEquals(5, $p->getNetPortfolioValue());
		}
	}

?>