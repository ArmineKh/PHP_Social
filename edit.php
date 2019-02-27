<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{
$user = $_SESSION['user'];
}

include_once("header.php");
?>



	<form method="post" action="server.php" class="w-25 mx-auto p-3 bg-dark text-light" >
		Name:	<input type="text"  name="name" class="form-control" value = "<?php print $user['name'] ?>">
		Surame: <input type="text"  name="surname" class="form-control" value = "<?php print $user['surname'] ?>">
		Age:	<input type="text"  name="age" class="form-control" value = "<?php print $user['age'] ?>">
		<button name="edit" class="btn btn-info">Edit</button>

	</form>
</body>
<script type="text/javascript" src="script.js"></script>
</html>