<?php


class client{

  public function __construct(){


  }

  public function getStock($Symbol){
    $data = file_get_contents('http://finance.google.com/finance/info?q=' . $Symbol);
    return $data;
  }

}

?>
