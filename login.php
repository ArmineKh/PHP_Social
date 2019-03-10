<?php 	
session_start();

if (isset($_SESSION["error"])) {
	$error = $_SESSION["error"];
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Social Network</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/profile.css">

</head>
<body>

	<?php include_once("template_pageTop.php"); ?>

	<form action="server.php" method="POST" class="w-25 mx-auto p-3 bg-dark text-light f">
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
		<input type="submit" name="logInbtn" class="btn btn-info" id="login" value= 'Login'>

	</form>
<?php include_once("template_pageBottom.php"); ?>

</body>
<?php 	
session_destroy();
 ?>
<script type="text/javascript" src="js/script.js"></script>
</html>