Feature: Login with wrong identification
	Login with wrong id
	Scenario: Logging in incorrectly
		Given I am on /login.php
		And I fill in email with user1@gmail.com
		And I fill in password with pw
		When I press loginbutton
		Then I should see page http://localhost/CS310-Stock/login.php
