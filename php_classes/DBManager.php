<?php
class DBManager
{
    // property declaration

    // method declaration
    public function __construct() {

    }
    public function addStock($stockTicker) {
    	//adds a stock to the database so that it will be in the user’s portfolio during future sessions
    }
    public function removeStock($stockTicker) {
    	//removes a stock from the databse so that it will not be in the user’s portfolio during future
    }
    public function logInAuthenticate($username, $password) {
    	//Usage: this function will cross check the parameters passed in to the ones stored in the database.  return boolean

    }
}
?>