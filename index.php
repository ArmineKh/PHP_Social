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
</head>
<body>
	<?php include_once("template_pageTop.php"); ?>
	<div class="w-25 mx-auto p-3 bg-dark text-light reg" >
		Name:			 	<input type="text"  id="name" class="form-control">
		Surame: 		 	<input type="text"  id="surname" class="form-control">
		Age:	 		 	<input type="text"  id="age" class="form-control">
		Email:	 	 		<input type="text"  id="email" class="form-control">
		Password:	 		<input type="password"  id="password" class="form-control">
		Password Confirm:   <input type="password"  id="cPassword" class="form-control">
		<button id="save" class="btn btn-info">Save</button>

	</div> 

<?php include_once("template_pageBottom.php"); ?>
</body>
<script type="text/javascript" src="js/script.js"></script>
</html>