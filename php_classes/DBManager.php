<?php
ini_set("display_errors", "on");

class DBManager
{
    // property declaration
    private $host, $dbname, $user, $pw, $pdo;

    // default constructor, connecting to the local MySQL database
    public function __construct()
    {
        $this->host = '127.0.0.1';
        $this->dbname = 'cs310';
        $this->user = 'root';
        $this->pw = 'van78756';

        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pw);
    }

    // return ALL users stored in the MySQL "users" table
    public function getUsers()
    {
        $sql = "SELECT * FROM users";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_OBJ);

        return $users;
    }

    // return a specific user's account_balance from MySQL users table
    public function getAccountBalance($userId)
    {
        $sql = "SELECT users.account_balance FROM users WHERE users.id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $balance = $statement->fetchAll(PDO::FETCH_OBJ);

        return $balance[0]->account_balance;

    }

    // return a specific user's portfolio_id in MySQL users table
    public function getPortfolioId($userId)
    {
        $sql = "SELECT * FROM portfolios WHERE portfolios.user_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $pID = $statement->fetchAll(PDO::FETCH_OBJ);

        return $pID[0]->id;
    }

    // return a specific user's watchlist_id in MySQL users table
    public function getWatchListId($userId)
    {
        $sql = "SELECT * FROM watchlists WHERE watchlists.user_id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $wID = $statement->fetchAll(PDO::FETCH_OBJ);

        return $wID[0]->id;
    }


    //adds a stock to the database so that it will be in the user’s portfolio during future sessions
    public function addStock($stockTicker, $portfolioId, $userId) {


        $sql = "INSERT IGNORE INTO stocks (stocks.stock_name, stocks.price) VALUES (?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->bindValue(2, 100, PDO::PARAM_INT);
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

        $sql = "UPDATE users SET users.account_balance = users.account_balance - 100 WHERE users.id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();

    }

    // adds a stock to the database that will be in the user's watchlist during future sessions
    public function addWatchListStock($stockTicker, $watchListId) {

        $sql = "INSERT IGNORE INTO stocks (stocks.stock_name, stocks.price) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->bindValue(2, 100, PDO::PARAM_INT);
        $statement->execute();


        $sql = "SELECT * FROM stocks WHERE stocks.stock_name = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $stockTicker, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        $stockId = $result[0]->id;

        $sql = "INSERT INTO watchlist_stocks (watchlist_stocks.watchlist_id, watchlist_stocks.stock_id) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $watchListId, PDO::PARAM_INT);
        $statement->bindValue(2, $stockId, PDO::PARAM_INT);
        $statement->execute();
    }

    // return a specific user's portfolio list of stocks from the MySQL users table
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

    // return a specific user's watchlist of stocks from the MySQL users table
    public function getWatchList($userId)
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

    // this function will cross check the parameters passed in to the ones stored in the database
    public function logInAuthenticate($email, $password) {
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

    // return a specific user's account_balance from the MySQL users table
    public function getBalance($userId){
        $sql = "SELECT * FROM user
                WHERE users.id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $userId, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_OBJ);


        if (empty($user))
        {
            return null;
        }

        return $user[0]->account_balance;
    }

    // removes a stock from the database so that it will not be in the user’s watchlist during future
    public function removeFromWatchList($watchlist_id, $stockID) {


        $sql = "DELETE FROM watchlist_stocks
                WHERE watchlist_stocks.watchlist_id = ?
                AND watchlist_stocks.stock_id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $watchlist_id, PDO::PARAM_INT);
        $statement->bindValue(2, $stockID, PDO::PARAM_INT);
        $statement->execute();

    }

    // removes a stock from the database so that it will not be in the user’s portfolio during future
    public function removeFromPortfolioList ($portfolio_id, $stockID){
        // removes a stock from a portfolio list

        $sql = "DELETE FROM portfoio_stocks
                WHERE portfolio_stocks.portfolio_id = ?
                AND portfolio_stocks.stock_id = ?";
        $statement = $this ->pdo->prepare($sql);
        $statement->bindValue(1, $portfolio_id, PDO::PARAM_INT);
        $statement->bindValue(2, $stockID, PDO::PARAM_INT);
        $statement->execute();
    }

    // this function will search the SQL database for stocks of similar names and return them in an array.
    public function searchStocks($stock_name){

        // USage: this function will search the SQL database for stocks of similar names and return them in an array.
        $sql = $this->pdo->prepare("SELECT * FROM symbols WHERE symbol LIKE '%".$stock_name."%' LIMIT 5");
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_OBJ);


        return $result;

    }
  }

?>
