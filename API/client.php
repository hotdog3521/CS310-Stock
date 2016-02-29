<?php


class client{


  public function getStock($Symbol){
    $data = file_get_contents('http://finance.google.com/finance/info?client=ig&q=' . $Symbol);
    return $data;
  }

}

?>
