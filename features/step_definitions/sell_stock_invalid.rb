When /^I click on sell invalid$/ do
	fill_in('tickerSymbolTrade', :with=>"GOOG")
	fill_in('quantityTrade', :with=>"999")
	click_button('sellButton')
	sleep(3)
	
end
