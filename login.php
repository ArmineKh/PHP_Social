<?php 	
session_start();

if (isset($_SESSION["error"])) {
	$error = $_SESSION["error"];
}


 ?>

<?php include_once("header.php"); ?>
	<form action="server.php" method="POST" class="w-25 mx-auto p-3 bg-dark text-light">
		<?php 	
		if (isset($error["email"])) {
		 	print $error["email"];
		 } ?>
		Email: <input type="text" name="email" class="form-control" id="email">
			<?php 	
		if (isset($error["password"])) {
		 	print $error["password"];
		 } ?>
		Password: <input type="password" name="password" class="form-control" id="password">
		<button name="loginbtn" class="btn btn-info" id="login">Login</button>

	</form>
</body>
<?php 	
session_destroy();
 ?>
<script type="text/javascript" src="js/script.js"></script>
</html>