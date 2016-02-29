<?php
require_once("header.php");

?>



<script type="text/javascript">
	// var form = $('#portfolio_form');

	// form.submit(function(e)
	// {
	// 	$.ajax({
	// 		type: form.attr('method'),
	// 		url: form.attr('action'),
	// 		data: form.serialize(),
	// 		success: function(data)
	// 		{
				
	// 		}
	// 	});

	// 	e.preventDefault();
	// });

</script>

<nav class="navbar navbar-inverse navbar-fixed-top" style="padding:3px 0px 7px 0px">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</button>
			<a class="navbar-brand" href="">Stock App</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li><a href="dashboard.php">Portfolio</a></li>
				<li><a href="watchlist.php">Watchlist</a></li>
				<li><a href="user_manual.php">User Manual</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right" style="margin-right:20px;">
				<li><a href="login.php">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="col-md-6 well" style="margin:100px auto; float:none;">
		<h1>Portfolio</h1>

		<form action="p_stock_search.php" method="get" id="portfolio_form" class="form-inline">
			<div class="form-group">
				<label class="control-label" for="stock">Company Name: </label>
				<input class="form-control" type="text" name="stock">
			</div>
			<button class="btn btn-success" type="submit">Search</button>
		</form>
		<br>
		<!-- <div class="table-responsive table-bordered">
			<table id="pSearch_Table" class="table">
				<thead>
					<th>Company Name</th>
					<th>Stock Name</th>
					<th>Add Stock</th>
				</thead>
				<tbody>
					<tr>
						
					</tr>
				</tbody>
			</table>
		</div> -->
	</div>
	<div class="col-md-6 well" style="margin:0px auto; float:none;">
		<h1>Watchlist</h1>
		
	</div>
</div>

<!-- The below is the code for the hisghstock graph -->


	
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
