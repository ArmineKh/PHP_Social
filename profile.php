<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
	$user = $_SESSION['user'];
}
// var_dump($user);


?>
<?php include_once('header.php'); ?>


<div class="row m-0">

	<div class="col-3">
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







<div class = "messDiv">
	<h6 class="friend_data">
		<b class="fr_data">Photo Name Surname</b>
		<img src="images/close.png" alt="" width="25" class="float-right close">
	</h6>
	<div class="message"></div>
	<textarea class="addMess" type="text" placeholder="type message...."></textarea>
	<img src="images/send.png" class = "send"  width = "30">
</div>


</body>
<script type="text/javascript" src="js/profile.js"></script>
</html>

