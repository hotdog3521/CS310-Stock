Feature: CS310-trader widget buy stock functionality

Scenario: Visit localhost/CS310-Stock/dashboard.php

Given:  I am on localhost/CS310-Stock/dashboard.php

When: I type in a valid ticker symbol and/or quantity. I click on buy

Then: I see my profile balance has been updated correctly