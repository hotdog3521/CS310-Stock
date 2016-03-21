Feature: Add Stock
	Should check functionality of stock ticker
	Scenario: Add stock to portfolio
		Given I am logged in
		And I searched the GOOG stock
		When I press addportfolio
		Then I should see page http://localhost/CS310-Stock/dashboard.php
		And I should see the GOOG stock in the #portfoliolist widget
