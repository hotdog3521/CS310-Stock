Feature: Account decrease when adding stock to portfolio	
	Scenario: Account decrease
		Given I am logged in
		And I am on /stock_info.php
		When I press addportfolio
		Then my account decreases
