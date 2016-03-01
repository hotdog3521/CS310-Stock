<?php
require_once("header.php");
require_once("navbar.php");
require_once("php_classes/PortfolioManager.php");
session_start();

$PM = new PortfolioManager($_SESSION['userId']);
$portfolioStocks = $PM->getStockList();

?>


<!-- START section for search widget UI-->
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
<!-- END section for search widget UI -->

<!-- START section for graph and sock/watch list widget -->
<div class="container">
	<div class="row" >
			<!-- START section for portfolio list and watch list tabs-->
			<div class="col-md-4 col-sm-4 well" style=" height:475px;">
				<ul class="nav nav-tabs" role="tablist">
				  <li class="active"><a href="#portfoliolist" role="tab" data-toggle="tab">Portfolio</a></li>
				  <li><a href="#watchlist" role="tab" data-toggle="tab">Watch List</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="portfoliolist">
				  		<div class="table-responsive table-bordered">
							<table id="pList_Table" class="table" style="font-size: 10px">
								<thead>
									<th>Ticker Symbol</th>
									<th>Quantity</th>
									<th>Visibility</th>
								</thead>
							</table>
						</div>
				  </div>
				  <div class="tab-pane" id="watchlist">
				  	<div class="table-responsive table-bordered">
							<table id="wList_Table" class="table" style="font-size: 10px">
								<thead>
									<th>Ticker Symbol</th>
									<th>Visibility</th>
									<th>BUTTON</th>
								</thead>
							</table>
						</div>
				  </div>
				</div>
			</div>
			<!--END section for portfolio list and watch list tabs -->

			<!-- START section for portfolio graph and watch graph tabs -->
			<div class="col-md-8 col-sm-8 well" style=" height:475px;">
				<ul class="nav nav-tabs" role="tablist">
				  <li class="active"><a href="#portfoliograph" role="tab" data-toggle="tab">
				 	Watchlist
				  </a>
				  </li>
				  <li><a href="#watchlistgraph" role="tab" data-toggle="tab">
				  	Portfolio
				  </a>
				  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="portfoliograph">
				  	<div id="pGraph"></div>
				  </div>
				  <div class="tab-pane" id="watchlistgraph">
				 	<div id="wGraph"></div>
				  </div>
				</div>
			</div>
			<!-- END section for portfolio graph and watch graph tabs -->
	</div>
</div>
<!-- END section for graph and stock/watch list widget -->
	
<!-- START section is for the Stock trader and Stock Details  UI -->
<div class="container">
	<div class="row">

		<!-- START section is for the Stock trader UI -->
		<div class="container col-m-4 col-sm-4 well">
			<form>
			  <div class="form-group">
			    <label for="TickerSymbolInput">Ticker Symbol</label>
			    <input type="text" class="form-control" id="tickerSymbolTrade" placeholder="Ticker Symbol">
			  </div>
			  <div class="form-group">
			    <label for="QuantityInput">Quantity</label>
			    <input type="numeric" min="0" class="form-control" id="quantityTrade" placeholder="Quantity">
			  </div>
			  <button type="submit" id="buyButton" class="btn btn-primary col-m-6 col-sm-6">Buy</button>
			  <button type="submit" id="sellButton" class="btn btn-success col-m-6 col-sm-6">Sell</button>
			</form>
		</div>
		<!-- END section is for the Stock trader UI -->
		
		<!-- START section is for the Stock Details UI -->
		<div class="container col-m-8 col-sm-8 well">

		</div>
		<!-- END section is for the Stock Detail UI -->
	</div>
</div>
<!-- END section is for the Stock trader and Stock Detail UI -->


<!-- script for graph -->
<script >
	$(function () 
	{
		console.log( "On window load" );	
		var seriesOptions = [],
		seriesCounter = 0,
		names = ['MSFT', 'AAPL', 'GOOG'];
	    /**
	     * Create the chart when all data is loaded
	     * @returns {undefined}
	     */
	    function createChart() 
	    {
	     	$('#pGraph').highcharts('StockChart', {
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

	     $.each(names, function (i, name)
	     {
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

</script>



</body>
</html>
