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
	        rangeSelector : {
	            selected : 1
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
	<div class="col-md-8" style="margin:100px auto; float:none;">
		<h1><?php echo $_SESSION['stock']; ?></h1>
		<div id="container" style="height: 400px; min-width: 310px"></div>
	</div>
</div>

</body>
</html>

