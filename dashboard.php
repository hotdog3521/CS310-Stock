<?php
require_once("header.php");
require_once("navbar.php");
session_start();
?>

<div class="container">
	<div class="col-md-6 well" style="margin:100px auto; float:none;">
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
	</div>
	

</div>

<div class="container">
	<div class="col-md-6 well" id="container" style="width:100%; height:400px;">
		
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
