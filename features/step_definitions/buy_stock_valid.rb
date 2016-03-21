When /^I click on buy valid$/ do
	fill_in('tickerSymbolTrade', :with=>"GOOG")
	fill_in('quantityTrade', :with=>"2")
	click_button('buyButton')
	sleep(3)
end

Then /^I see my profile balance has been decreased$/ do
	find('div#accountBalanceDiv').text[1..9].to_i.should_not equal(10000)
end