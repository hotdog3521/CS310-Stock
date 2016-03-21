Given /^I am on localhost\/CS310-Stock\/dashboard\.php$/ do
	visit('/')
end

When /^I click on buy$/ do
	click_button("buyButton")
end

Then /^I see no difference$/ do

end
