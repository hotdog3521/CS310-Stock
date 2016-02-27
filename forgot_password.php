<?php
	ini_set('display_errors', 'On');
	require_once("header.php");
	require_once("php_classes/DBManager.php");

?>

<div class="container">
	<div class="col-md-6 well" style="margin:20px auto; float:none;">
		<form action="process_password.php" method="post">
			<div class="form-group">
				<label class="control-label" for="password">Password: </label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">
				<label class="control-label" for="confirm_password">Confirm Password: </label>
				<input class="form-control" type="password" name="confirm_password">
			</div>
			<button class="btn btn-success" type="submit">Set Password</button>
		</form>
	</div>
</div>


</body>
</html>