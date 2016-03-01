<?php
require_once("header.php");
require_once("navbar.php");
require_once("php_classes/PortfolioManager.php");
session_start();

$PM = new PortfolioManager($_SESSION['userId']);
$portfolioStocks = $PM->getStockList();

?>
<div class="container">
	<h1 style="margin:100px auto 10px auto; float:none;">Portfolio</h1>
	<div class="col-md-4 com-sm-4 well">
		<?php if (isset($_SESSION['errors'])) : ?>
			<p><?php echo $_SESSION['errors']; $_SESSION['errors'] = NULL; ?></p>
		<?php endif ?>
		<form action="p_stock_search.php" method="get" id="portfolio_form" class="form-inline">
			<div class="form-group">
				<label class="control-label" for="stock">Stock Ticker: </label>
				<input class="form-control" type="text" name="stock">
			</div>
			<button class="btn btn-success" type="submit">Search</button>
		</form>
		<br>
		<div class="table-responsive table-bordered">
			<table id="pSearch_Table" class="table">
				<thead>
					<th>Stock Name</th>
				</thead>
				<tbody>
					<?php foreach ($portfolioStocks as $stock) : ?>
						<tr>
							<td><?php echo $stock->stock_name ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="container">
	<h1>Watchlist</h1>
	<div class="col-md-12 well" id="container" style="width:100%; height:400px;">
	</div>
</div>
<script >
	$(function () {
		console.log( "On window load" );	
		var seriesOptions = [],
		seriesCounter = 0,
		names = ['MSFT', 'AAPL', 'GOOG'];
    /**
     * Create the chart when all data is loaded
     * @returns {undefined}
     */
     function createChart() {
     	$('#container').highcharts('StockChart', {
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
     		yAxis: {
     			labels: {
     				formatter: function () {
     					return (this.value > 0 ? ' + ' : '') + this.value + '%';
     				}
     			},
     			plotLines: [{
     				value: 0,
     				width: 2,
     				color: 'silver'
     			}]
     		},
     		plotOptions: {
     			series: {
     				compare: 'percent'
     			}
     		},
     		tooltip: {
     			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
     			valueDecimals: 2
     		},
     		series: seriesOptions
     	});
     }
     $.each(names, function (i, name) {
     	$.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=' + name.toLowerCase() + '-c.json&callback=?',    function (data) {
     		console.log( "Inside function JSON callback" );
     		seriesOptions[i] = {
     			name: name,
     			data: data
     		};
            // As we're loading the data asynchronously, we don't know what order it will arrive. So
            // we keep a counter and create the chart when all the data is loaded.
            seriesCounter += 1;
            if (seriesCounter === names.length) {
            	createChart();
            }
        });
     });
 });

/*var chart1; // globally available
$(function() {
      chart1 = new Highcharts.StockChart({
         chart: {
            renderTo: 'container'
         },
         rangeSelector: {
            selected: 1
         },
         series: [{
            name: 'USD to EUR',
            data: data // predefined JavaScript array
         }]
      });
   });
   */
</script>



</body>
</html>
