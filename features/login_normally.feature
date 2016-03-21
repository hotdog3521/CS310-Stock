Feature: Login with normal existing identification
	This feature should test normal login functionality
	Scenario: Logging in
		Given I am on /login.php
		And I fill in email with user1@gmail.com
		And I fill in password with password
		When I press loginbutton
		Then I should see page http://localhost/CS310-Stock/dashboard.php
