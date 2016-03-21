Feature: CS310-trader widget sell stock functionality

Scenario: Visit localhost/CS310-Stock/dashboard.php

Given:  I am on localhost/CS310-Stock/dashboard.php

When: I type in a valid ticker symbol and quantity. I click sell.

Then: I see my profile balance updated correctly.