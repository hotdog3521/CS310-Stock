<?php
ini_set("display_errors", "on");

class DBManager
{
    // property declaration
    private $host, $dbname, $user, $pw, $pdo;

    public function __construct()
    {
        $this->host = '127.0.0.1';
        $this->dbname = 'cs310';
        $this->user = 'root';
        $this->pw = 'van78756';

        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pw);
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_OBJ);

        return $users;
    }

    public function getPortfolioId($userId)
    {
        $sql = "SELECT * FROM portfolios WHERE portfolios.user_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $pID = $statement->fetchAll(PDO::FETCH_OBJ);

        return $pID[0]->id;
    }

    public function getWatchListId($userId)
    {
        $sql = "SELECT * FROM watchlists WHERE watchlists.user_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $wID = $statement->fetchAll(PDO::FETCH_OBJ);

        return $wID[0]->id;
    }

    public function addStock($stockTicker, $portfolioId) {
    	//adds a stock to the database so that it will be in the user’s portfolio during future sessions

        $sql = "INSERT IGNORE INTO stocks (stocks.stock_name) VALUES (?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->execute();


        $sql = "SELECT * FROM stocks WHERE stocks.stock_name = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        $stockId = $result[0]->id;

        $sql = "INSERT IGNORE INTO portfolio_stocks (portfolio_stocks.portfolio_id, portfolio_stocks.stock_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $portfolioId, PDO::PARAM_INT);
        $statement->bindValue(2, $stockId, PDO::PARAM_INT);
        $statement->execute();

    }
    public function addWatchListStock($stockTicker, $watchListId) {
        // adds a stock tot he database that will be in the user's watchlist during future sessions

        $sql = "INSERT IGNORE INTO stocks (stocks.stock_name) VALUES (?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->execute();


        $sql = "SELECT * FROM stocks WHERE stocks.stock_name = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        $stockId = $result[0]->id;

        $sql = "INSERT IGNORE INTO watchlist_stocks (watchlist_stocks.watchlist_id, watchlist_stocks.stock_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $watchListId, PDO::PARAM_INT);
        $statement->bindValue(2, $stockId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getPortfolio($userId)
    {
        $sql = "SELECT stocks.id, stocks.stock_name FROM stocks
            LEFT JOIN portfolio_stocks ON portfolio_stocks.stock_id = stocks.id 
            LEFT JOIN portfolios ON portfolios.id = portfolio_stocks.portfolio_id 
            LEFT JOIN users ON users.id = portfolios.user_id
            WHERE users.id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $stocks = $statement->fetchAll(PDO::FETCH_OBJ);

        return $stocks;
    }

    public function getWatchList($userID)
    {
        $sql = "SELECT stocks.id, stocks.stock_name FROM stocks
            LEFT JOIN watchlist_stocks ON watchlist_stocks.stock_id = stocks.id 
            LEFT JOIN watchlists ON watchlists.id = watchlist_stocks.watchlist_id 
            LEFT JOIN users ON users.id = watchlists.user_id
            WHERE users.id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $stocks = $statement->fetchAll(PDO::FETCH_OBJ);

        return $stocks;
    }


    /*
    public function removeStock($stockTicker) {
    	//removes a stock from the databse so that it will not be in the user’s portfolio during future
    }
    */
    public function logInAuthenticate($email, $password) {
    	//Usage: this function will cross check the parameters passed in to the ones stored in the database.  return boolean
        $sql = "SELECT * FROM users
                WHERE users.email = ?
                AND users.password = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email, PDO::PARAM_STR);
        $statement->bindValue(2, $password, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_OBJ);

        if (empty($user))
        {
            return null;
        }

        return $user[0]->id;
    }
    /*


    public function updateWatchList($watchlist_id, $new_watchlist){

        // clear the watchlist_stock table of the user's old watchlist stocks
        $sql = "DELETE FROM watchlist_stocks
                WHERE watchlist_stocks.watchlist_id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement -> bindValue(1, $watchlist_id, PDO::PARAM_INT);
        $statement->execute();
      }


    // takes in a watchlist_id from a particular user
    public function getWatchlist($watchlist_id){

        $sql = "SELECT * FROM watchlist_stocks
                WHERE watchlist_stocks.watchlist_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $watchlist_id, PDO::PARAM_INT);
        $statement->execute();

        //result stores all the stock_ids in the watchlist
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        //initialize empty array
        $watchList = array();

        // iterate through every stock_id in the resulting array
        for ($i = 0; $i < count($result); ++$i){

            $stock_id = $result[$i]->stock_id;

            // pull the corresponding stock info from stock table
            $sql2 = "SELECT * FROM stocks
                    WHERE stocks.id = ?";
            $statement2 = $this->pdo->prepare($sql);
            $statement2->bindValue(1, $stock_id, PDO::PARAM_INT);
            $statement2->execute();
            $stock_result = $statement2->fetchAll(PDO::FETCH_OBJ);

            // create a new Stock Object, put it in the array
            $stock = new Stock($stock_result[0]->company_name, $stock_result[0]->stock_name, 0, 0, $stock_id);
            array_push($watchList, $stock->getName(), $stock);
        }

        return $watchList;

    }

    public function getPortfolioList($portfolio_id){
        $sql = "SELECT * FROM portfolio_stocks
                WHERE portfolio_stocks.portfolio_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $portfolio_id, PDO::PARAM_INT);
        $statement->execute();

        //result stores all the stock_ids in the portfolio_list
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        //initialize empty array
        $portfolioList = array();

        // iterate through every stock_id in the resulting array
        for ($i = 0; $i < count($result); ++$i){

            $stock_id = $result[$i]->stock_id;

            // pull the corresponding stock info from stock table
            $sql2 = "SELECT * FROM stocks
                    WHERE stocks.id = ?";
            $statement2 = $this->pdo->prepare($sql);
            $statement2->bindValue(1, $stock_id, PDO::PARAM_INT);
            $statement2->execute();
            $stock_result = $statement2->fetchAll(PDO::FETCH_OBJ);

            // create a new Stock Object, put it in the array
            $stock = new Stock($stock_result[0]->company_name, $stock_result[0]->stock_name, 0, 0, $stock_id);
            array_push($portfolioList, $stock->getName(), $stock);
        }

        return $portfolioList;
    }

    // takes in a watchlist ID and a stock Object
    public function addToWatchList($watchlist_id, $stock){

    }
    */

    public function removeFromWatchList($watchlist_id, $stock) {
    	//removes a stock from the databse so that it will not be in the user’s portfolio during future


        $sql = "DELETE FROM watchlist_stocks
                WHERE watchlist_stocks.watchlist_id = ?
                AND watchlist_stocks.stock_id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $watchlist_id, PDO::PARAM_INT);
        $statement->bindValue(2, $stock->getID(), PDO::PARAM_INT);
        $statement->execute();

    }

    public function removeFromPortfolioList ($portfolio_id, $stock){
        // removes a stock from a portfolio list

        $sql = "DELETE FROM portfoio_stocks
                WHERE portfolio_stocks.portfolio_id = ?
                AND portfolio_stocks.stock_id = ?";
        $statement = $this ->pdo->prepare($sql);
        $statement->bindValue(1, $portfolio_id, PDO::PARAM_INT);
        $statement->bindValue(2, $stock->getID(), PDO::PARAM_INT);
        $statement->execute();
    }

    public function searchStocks($stock_name){
        // USage: this function will search the SQL database for stocks of similar names and return them in an array.
        $sql = $this->pdo->prepare("SELECT * FROM symbols WHERE symbol LIKE '%".$stock_name."%'");
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_OBJ);


        return $result;

    }
  }

?>
