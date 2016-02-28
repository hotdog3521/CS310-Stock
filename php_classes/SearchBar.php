<?php

class SearchBar
{
    // property declaration
    private $mAPI;    //APIManager
    private $mPM;    //PorfolioManager

    public function _construct($mPM, $mAPI) {
        //constructor
        $this->mAPI = $mAPI;
        $this->mPM = $mPM;

    }

    // method declaration
    public function search($companyName) : Array (String) {
        //returns an array of strings that is populated through the API.
    }

}
?>