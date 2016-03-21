Given /^I am on dashboard$/ do
	visit('login.php')
	fill_in('email', :with=>"user1@gmail.com")
	fill_in('password', :with=>"password")
	sleep(2)
	click_button('loginbutton', exact:true)
	sleep(2)
	#find_field('password').native.send_key(:enter)
end

When /^I click on buy empty$/ do
	click_button('buyButton')
	
end

Then /^I see no difference$/ do
	find('div#accountBalanceDiv').text[1..9].to_i.should equal(10000)
end
