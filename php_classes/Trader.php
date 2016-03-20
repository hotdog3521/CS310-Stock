<?php

class Trader
{
    // property declaration
    private $mAPI;        //APIManager
    private $portfolioManager;     //PortfolioManager

    public function  __construct($mAPI, $portfolioManager) {
        //constructor
        $this->mAPI = $mAPI;
        $this->portfolioManager = $portfolioManager;

    }

    // method declaration
    public function isStock($companyName) {
        return $this->mAPI->isStock($companyName);
        //verifies if the specified stock name is valid or not.
    }
    public function canBuy($stock,$quantity) {
        //verifies if the user has sufficient funds to buy the stock at the given quantity.
            if($this->portfolioManager->getBallance()>= 100*$quantity){
                return true;
            }else {
                return false;
            }
    }
    public function buyStock($stock, $quantity) {
        //accesses the API and purchases the stocks And update user’s portfolio.
    	if(isStock($stock)==false){

    		//error popup function
    		return;
    	}
    	if(canBuy($stock,$quantity)==false){
    		//error popup function
    		return;
    	}

        // $ballance=$this->portfolioManager->getBallance();
        // $ballance= $ballance-(100*quantity);
        // $this->portfolioManager->setBallance($ballance);
        // $this->portfolioManager->addStock($Stock);
        
    	//Confirmation Popup
    	//if yes
 		// up date net portfolio value and ballance
    	//add stock with quantity to portfolio
    }
    public function sellStock($stock, $quantity) {
        //accesses the API and sells the stocks. And update user’s portfolio
    	$stockList = $this->portfolioManager->getStockList();
    	if($stockList[$stock]->getQuantity() >= $quantity){
			//update net portfolio value and account ballance
			//confirmation popup function (Front end JS)
			//sell stock

    	} else {
    		//error popup function
    		return;
    	}
    }

}
?>
