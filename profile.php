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
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>

<nav class="navbar navbar-expand-md ">
  <!-- Brand -->
  <a  href="profile.php">
        <img id="i" src="images/logo.png" alt="logo" title="Social Network">
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav justify-content-end w-100">
      <li class="nav-item mr-2 friend_block">
        <img src="images/friend.png" alt="" class="friend_icon">
        <div id="friend_list" class="mx-auto p-3 bg-dark text-light"></div>
      </li>
      <li class="nav-item mr-2 notific_block">
      	<img src="images/notific.png" alt="" class="notific_icon">
      	<div id="request_result" class="mx-auto p-3 bg-dark text-light"></div>
      </li>
      <li class="nav-item  mr-2" style="position: relative;">
			<input type="text" id="search" class="form-control" placeholder="Search">
			<div id="search_result" class=" bg-dark text-light" style="position: absolute;"></div>
      </li>
      <li class="nav-item mr-2">
      	<a class="nav-link btn" style="background-color: #5cb2e4" href="edit.php">Edit Data</a>
      </li>
      <li class="nav-item mr-2">
      	<a  class="nav-link btn btn-danger" style="background-color: #9c5259"  href="login.php">Log Out</a>
      </li> 
    </ul>
  </div> 
</nav>

<div class = "messDiv">
  <h6 class="friend_data">
    <b class="fr_data">Photo Name Surname</b>
    <img src="images/close.png" alt="" width="25" class="float-right close">
  </h6>
  <div class="message"></div>
  <textarea class="addMess" type="text" placeholder="type message...."></textarea>
  <img src="images/send.png" class = "send"  width = "30">
</div>

<div class="row m-0">

	<div class="col-3">
		<input type="hidden" id='id' value='<?=$user['id'] ?>'>
		<img src="<?php print $_SESSION['user']['photo'] ?>" width = "200" height = "200">
		<form action="server.php" method="POST" enctype="multipart/form-data" class="p-3 bg-dark text-light myform">
			<input type="file" name="img" class="form-control profpic">
		</form>

		<h1><?= $user["name"]." ".$user["surname"] ?></h1>
		<h1><?php print $user["age"] ?></h1>
	</div>
	<div class="statusDiv col-7 pt-4">
		<div class="typeStatus">
			<textarea class="addStatus" type = "text" placeholder="type status...."></textarea>
			<img src="images/post.png" class="post"> 
		</div>
		<div class="showStatus"></div>
	</div>
</div>

</body>
<script type="text/javascript" src="js/profile.js"></script>
</html>

