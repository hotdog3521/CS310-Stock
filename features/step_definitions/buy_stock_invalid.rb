When /^I click on buy invalid$/ do
	fill_in('tickerSymbolTrade', :with=>"GOOG")
	fill_in('quantityTrade', :with=>"20000")
	click_button('buyButton')
	sleep(3)
	
end

