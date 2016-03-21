Feature: Searching from Search Bar

	Scenario: Load Suggestions
		Given I am logged in
		When I fill in stock with GOOG
		And I press searchbutton
		Then I should see page http://localhost/CS310-Stock/stock_info.php
		And the page should have GOOG in a title
