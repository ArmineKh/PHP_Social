<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
	$user = $_SESSION['user'];

}


?>
<?php include_once('header.php'); ?>

</body>
<script type="text/javascript" src="js/profile.js"></script>
</html>