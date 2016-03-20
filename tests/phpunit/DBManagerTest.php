<?php
require_once("php_classes/DBManager.php");

class DBManagerTest extends PHPUnit_Framework_TestCase 
{
	private $db;

	// Tests the getUsers function
	public function testGetUsers()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$users = $this->db->getUsers();

		// Assert
		$this->assertNotEmpty($users);
	}

	// Tests the getAccountBalance function
	public function testGetAccountBalance()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$balance = $this->db->getAccountBalance(12);

		// Assert
		$this->assertEquals(10000, $balance);
	}

	// Tests the getPortfolioId function
	public function testGetPortfolioId()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$portfolioID = $this->db->getPortfolioId(12);

		// Assert
		$this->assertEquals(8, $portfolioID);
	}

	// Tests the getWatchlistId function
	public function testGetWatchListId()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$watchlistID = $this->db->getWatchListId(12);

		// Assert
		$this->assertEquals(8, $watchlistID);
	}

	// Tests the addStock function
	public function testAddStock()
	{
		// Arrange
		$this->db = new DBManager();
		$name = "COST";

		// Act
		$this->db->addStock($name, 9, 14);
		$stocks = $this->db->getPortfolio(14);

		// Assert
		$this->assertNotEmpty($stocks);
	}

	// Tests the addWatchlistStock function
	public function testAddWatchlistStock()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$this->db->addWatchListStock("CMG", 9);
		$watchlist = $this->db->getWatchList(14);

		// Assert
		$this->assertNotEmpty($watchlist);
	}

	// Tests getPortfolio function
	public function testGetPortfolio()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$portfolio = $this->db->getPortfolio(14);

		// Assert
		$this->assertNotEmpty($portfolio);
	}

	// Tests getWatchlist function
	public function testGetWatchList()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$watchlist = $this->db->getWatchList(14);

		// Assert
		$this->assertNotEmpty($watchlist);
	}

	// Tests loginAuthenticate function
	public function testLoginAuthenticate()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$id = $this->db->logInAuthenticate("user1@gmail.com", "password");

		// Assert
		$this->assertNotNull($id);
	}

	// Tests removeFromPortfolioList function
	public function testRemoveFromPortfolioList()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$this->db->removeFromPortfolioList(9, 16);
		$portfolio = $this->db->getPortfolio(14);

		// Assert
		$this->assertFalse(in_array("COST", $portfolio));
	}

	// Tests removeFromWatchlist function
	public function testRemoveFromWatchlist()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$this->db->removeFromWatchList(9, 10);
		$watchlist = $this->db->getWatchList(14);

		// Assert
		$this->assertFalse(in_array("CMG", $watchlist));
	}

	// Tests searchStocks function
	public function testSearchStocks()
	{
		// Arrange
		$this->db = new DBManager();

		// Act
		$results = $this->db->searchStocks("G");

		// Assert
		$this->assertEquals(5, count($results));

	}




}