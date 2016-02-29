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
	<div class="col-md-6 well" style="margin:0px auto; float:none;">
		<h1>Watchlist</h1>
		
	</div>
</div>


</body>
</html>
