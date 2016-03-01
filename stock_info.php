<?php
require_once("header.php");
require_once("navbar.php");
session_start();
?>

<script type="text/javascript">

$(function()
{
 	$.get("stock_data.txt", function(data)
 	{
 		var historical_prices = JSON.parse(data);
	    $('#container').highcharts('StockChart',
	    {
	    	xAxis: {
	    		minRange: 1 * 24 * 3600 * 1000
	    	},
	        rangeSelector : {
	        	allButtonsEnabled: true,
	        	buttons: [{
	        		type: 'day',
	        		count: 1,
	        		text: '1 day'
	        	}, {
	        		type: 'day',
	        		count: 5,
	        		text: '5 days'
	        	}, {
					type: 'month',
					count: 1,
					text: '1m'
				}, {
					type: 'month',
					count: 3,
					text: '3m'
				}, {
					type: 'month',
					count: 6,
					text: '6m'
				}, {
					type: 'all',
					text: 'All'
				}],
	            selected : 4
	        },

	        series : [{
	        	turboThreshold : 0,
	            name : 'Price',
	            data : historical_prices,
	            tooltip: {
	                valueDecimals: 2
	            }
	        }]
	    });
	});
});


</script>

<div class="container">
	<div class="col-md-8" style="margin:100px auto 10px auto; float:none;">
		<h1><?php echo $_SESSION['symbol']; ?></h1>
		<div id="container" style="height: 400px; min-width: 310px"></div>
	</div>
	<div class="row">
		<div class="col-md-6" style="display:inline-block;">
			<form action="add_to_portfolio.php" method="post">
				<input type="hidden" name="stock" value="<?php echo $_SESSION['symbol'] ?>">
				<button class="btn btn-success" type="submit">Add Stock to Portfolio</button>
			</form>
		</div>
		<div class="col-md-6" style="display:inline-block;">
			<form action="add_to_watchlist.php" method="post" style="margin-left: 200px;">
				<input type="hidden" name="stock" value="<?php echo $_SESSION['symbol'] ?>">
				<button class="btn btn-success" type="submit">Add Stock to Watchlist</button>
			</form>
		</div>
	</div>

</div>

</body>
</html>

