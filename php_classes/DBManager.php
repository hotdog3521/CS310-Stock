<?php
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

    public function loginUser($email, $password)
    {

    }

    public function addStock($stockTicker) {
    	//adds a stock to the database so that it will be in the user’s portfolio during future sessions
    }
    public function removeStock($stockTicker) {
    	//removes a stock from the databse so that it will not be in the user’s portfolio during future
    }
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
            return false;
        }

        return true;

    }
}
?>