<?php
require_once("header.php");
require_once("navbar.php");
session_start();
?>
<div class="row">
	<div class="container">
		<div class="col-md-4 com-sm-4 well" style="margin:100px auto; float:none;">
			<h1>Portfolio</h1>
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
						<th>Company Name</th>
						<th>Stock Name</th>
						<th>Opening Price</th>
						<th>Add Stock</th>
					</thead>
				</table>
			</div>
		</di>
	</div>
	
</div>
</div>
<div class="container">
	<div class="row" >
		
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
		
			<div class="col-md-8 col-sm-8 well" style=" height:475px;">
				<ul class="nav nav-tabs" role="tablist">
				  <li class="active"><a href="#portfoliograph" role="tab" data-toggle="tab">
				 	 Portfolio
				  </a>
				  </li>
				  <li><a href="#watchlistgraph" role="tab" data-toggle="tab">
				  	Watchlist
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
		
		
	</div>
</div>

<div class="container">
	<div class="row">
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
		<div class="container col-m-8 col-sm-8 well">

		</div>
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
     	$('#pGraph').highcharts('StockChart', {
     		rangeSelector: {
     			selected: 4
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

</script>



</body>
</html>
