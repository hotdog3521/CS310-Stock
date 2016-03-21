<?php
require_once("header.php");
require_once("navbar.php");
require_once("php_classes/PortfolioManager.php");
require_once("php_classes/DBManager.php");
session_start();

$PM = new PortfolioManager($_SESSION['userId']);
$portfolioStocks = $PM->getStockList();
$watchlistStocks = $PM->getWatchList();
$accountBalance = $PM->getBalance();

$db = new DBManager();

date_default_timezone_set('US/Eastern');

?>

<script src="jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="style.css" />

<script type="text/javascript">
	
	function autocomplet()
	{
		var min_length = 1;
		var keyword = $("#search_bar").val();
		if (keyword.length >= min_length)
		{
			$.ajax({
				url: 'ajax_autocomplete.php',
				type: 'POST',
				data: {keyword:keyword},
				success: function(data)
				{
					$("#search_bar_list").show();
					$("#search_bar_list").html(data);
				}
			});
		}
		else
		{
			$("#search_bar_list").hide();
		}
	}


	function set_item(item)
	{
		$("#search_bar").val(item);
		$("#search_bar_list").hide();
	}

</script>


<!-- START section for search widget UI-->
<div class="container">
	<div class="row" style="margin:100px auto 10px auto; float:none;">
		<div class="col-md-6" style="display: inline-block;">
			<h1 >Portfolio</h1>
		</div>
		<div class="col-md-6" style="display: inline-block; margin-left: 200px;">
			<h3>US/Eastern Time: <?php echo date('h:i A'); ?></h3>
		</div>
	</div>
	<div class="col-md-8 well">
		<div class="row">
			<div class="col-md-4" style="display: inline-block;">
				<?php if (isset($_SESSION['errors'])) : ?>
					<p><?php echo $_SESSION['errors']; $_SESSION['errors'] = NULL; ?></p>
				<?php endif ?>
		        <div class="content">
					<form action="p_stock_search.php" method="get" id="portfolio_form" class="form-inline">
						<div class="form-group">
							<div style="display: inline-block;">
								<label class="control-label" for="stock">Stock Ticker: </label>
							</div>
							<div class="input_container" style="display: inline-block;">
								<input id="search_bar" class="form-control" type="text" name="stock" onkeyup="autocomplet()" autocomplete="off">
								<ul id="search_bar_list"></ul>
							</div>
						</div>
						<button class="btn btn-success" type="submit">Search</button>
					</form>
				</div>
			</div>
			<div class="col-md-4" style="display: inline-block;">
				<h4>Account Balance: $<?php echo $accountBalance ?></h4>
			</div>
		</div>
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
				  <div class="tab-pane" id="watchlist">
				  	<div class="table-responsive table-bordered">
							<table id="wList_Table" class="table" style="font-size: 10px">
								<thead>
									<th>Ticker Symbol</th>
									<th>Visibility</th>
									<th>BUTTON</th>
								</thead>
								<tbody>
									<?php foreach ($watchlistStocks as $stock) : ?>
										<tr>
											<td class="watchlistStock"><?php echo $stock->stock_name ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
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
		<div class="container col-m-4 col-sm-4 well" style="height: 225px">
			<form>
			  <div class="form-group">
			    <label for="TickerSymbolInput">Ticker Symbol</label>
			    <input type="text" class="form-control" id="tickerSymbolTrade" placeholder="Ticker Symbol">
			  </div>
			  <div class="form-group">
			    <label for="QuantityInput">Quantity</label>
			    <input type="number" min="0" class="form-control" id="quantityTrade" placeholder="Quantity">
			  </div>
			  <button type="submit" id="buyButton" class="btn btn-primary col-m-6 col-sm-6">Buy</button>
			  <button type="submit" id="sellButton" class="btn btn-success col-m-6 col-sm-6">Sell</button>
			</form>
		</div>
		<!-- END section is for the Stock trader UI -->
		
		<!-- START section is for the Stock Details UI -->
		<div class="container col-m-8 col-sm-8 well" style="height: 225px">
			<div class="table-responsive">
				<table id="StockDetails_Table" class="table table-striped input-m">
					<thead>
						<th>Ticker Symbol</th>
						<th></th>
					</thead>
					<tbody>
						<tr>
							<td>
								Company Name: 
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								Ticker Symbol:
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								Opening Price:
							</td>
							<td>
								Closing Price:
							</td>
						</tr>
						<tr>
							<td>
								Quantity Owned:
							</td>
							<td>
								Percent Changed
							</td>
						</tr>
					</tbody>
				</table>
			</div>
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
