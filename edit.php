<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
$user = $_SESSION['user'];
}
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
	<form method="post" action="server.php" class="w-25 mx-auto p-3 bg-dark text-light" >
		Name:	<input type="text"  name="name" class="form-control" value = "<?php print $user['name'] ?>">
		Surame: <input type="text"  name="surname" class="form-control" value = "<?php print $user['surname'] ?>">
		Age:	<input type="text"  name="age" class="form-control" value = "<?php print $user['age'] ?>">
		<button name="edit" class="btn btn-info">Edit</button>

	</form>
</body>
<script type="text/javascript" src="script.js"></script>
</html>