<?php
// require_once("stock_data.php");
ini_set("display_errors", "on");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


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

	        // title : {
	        //     text : 'GOOG Stock Price'
	        // },

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





<div id="container" style="height: 400px; min-width: 310px"></div>




