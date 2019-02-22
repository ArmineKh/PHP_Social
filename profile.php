<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
	$user = $_SESSION['user'];
}
// var_dump($user);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="w-25 mx-auto p-3 bg-dark text-light" style="position: relative;">
		<input type="text" id="search" class="form-control" placeholder="Search">
		<div id="search_result" class=" mx-auto bg-dark text-light" style="position: absolute;"></div>
	</div>
	<h1><?php print $user["name"] ?></h1>
	<h1><?php print $user["surname"] ?></h1>
	<h1><?php print $user["age"] ?></h1>
	<img src="<?php print $_SESSION['user']['photo'] ?>" width = "200" height = "200">
	<form action="server.php" method="POST" enctype="multipart/form-data" class="w-25 mx-auto p-3 bg-dark text-light">
		<input type="file" name="img" class="form-control">
		<button class="btn btn-success">Save</button>
	</form>
	<a href="edit.php">Edit</a>
	<a href="login.php">Log out</a>
</body>
<script type="text/javascript" src="script.js"></script>
</html>

