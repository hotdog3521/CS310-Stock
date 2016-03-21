Feature: CS310-trader widget sell stock functionality

Scenario: Visit localhost/CS310-Stock/dashboard.php

Given:  I am on localhost/CS310-Stock/dashboard.php

When: I type in an invalid ticker symbol and/or quantity. I click sell.

Then: I see my profile balance doesn't update.