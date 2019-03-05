<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
	$friend = $_SESSION['friend'];

}


?>
<?php include_once('header.php'); ?>

<div class="row m-0 friendProfile">

	<div class="col-3">
		<img src="<?php print $friend['photo'] ?>" width = "200" height = "200">
		

		<h1><?= $friend["name"]." ".$friend["surname"] ?></h1>
		<h1><?php print $friend["age"] ?></h1>
	</div>
	
</div>

</body>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/friend.js"></script>
</html>