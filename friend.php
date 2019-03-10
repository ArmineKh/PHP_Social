<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{

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
  <link rel="stylesheet" href="css/friend.css">

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
      <li class="nav-item  mr-2"style="position: relative;">
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


<input type="hidden" id="fr_id" value="<?=$_GET['id'] ?>">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link menu1" data-toggle="tab" href="#menu1">Photos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Status</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu3">Friends</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home"></div>
  <div class="tab-pane container fade" id="menu1"></div>
  <div class="tab-pane container fade" id="menu2"> </div>
  <div class="tab-pane container fade" id="menu3"></div>

</div>
<div id="fr_div"></div>

</body>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/friend.js"></script>
</html>