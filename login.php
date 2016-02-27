<?php
	require_once("header.php");
	require_once("DBManager.php");
?>

<div class="container">
	<div class="col-md-8 well" style="margin:20px auto; float:none;">
		<h1>Login</h1>
		<form action="process_user.php" method="post">
			<div class="form-group">
				<label class="control-label" for="username">Username: </label>
				<input class="form-control" type="text" name="username">
			</div>
			<div class="form-group">
				<label class="control-label" for="password">Password: </label>
				<input class="form-control" type="password" name="password">
			</div>
			<button class="btn btn-success" type="submit">Login</button>
		</form>
	</div>
</div>


</body>
</html>
