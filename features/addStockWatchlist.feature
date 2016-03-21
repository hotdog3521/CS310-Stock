Feature: Add Stock to Watchlist
	Scenario: Add stock to watchlist
		Given I am logged in
		And I searched the GOOG stock
		When I press addwatchlist
		Then I should see page http://localhost/CS310-Stock/dashboard.php
		And I should see the GOOG stock in the #watchlist widget
