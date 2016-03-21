When /^I click on sell valid$/ do
	fill_in('tickerSymbolTrade', :with=>"GOOG")
	fill_in('quantityTrade', :with=>"1")
	click_button('sellButton')
	sleep(3)
	
end

Then /^I see my profile balance has been increased$/ do
	find('div#accountBalanceDiv').text[1..9].to_i.should_not equal(10000)
end