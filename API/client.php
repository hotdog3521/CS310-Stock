<?php


class client{

  public function __construct(){


  }

  public function getStock($Symbol){
    $data = @file_get_contents('http://finance.google.com/finance/info?q=' . $Symbol);
    if(strlen($data)!=0){
      $data = str_replace("\n", "", $data);
      $data = substr($data, 4, strlen($data) -5);
      $json = json_decode(utf8_decode($data));

      $output = array(
          "symbol" => $json->t,
          "market" => $json->e,
          "price" => $json->l,
          "datetime" => $json->lt
      );

      return $output;
    }
    else
      return 0;
  }

}

?>
