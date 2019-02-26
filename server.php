<?php 
class Ajax{
	private  $db;
	function __construct(){
		session_start();
		$this->db = new mysqli("localhost", "root", "", "db");
		if (isset($_POST["action"])){
			if($_POST["action"] == "ajax1"){
				$this->signup();
			}  else if ($_POST["action"] == "ajax2") {
				$this->search();
			} else if ($_POST["action"] == "ajax3") {
				$this->addFriendRequest();
			}
			else if ($_POST["action"] == "getRequest") {
				$this->getRequest();
			} else if($_POST['action'] == "addFriend"){
				$this->addFriend();
			} else if($_POST['action'] == "deleteRequest"){
				$this->deleteRequest();
			} else if($_POST['action'] == "showFriends"){
				$this->showFrinds();
			} else if($_POST['action'] == "selectFriend"){
				$this->selectFriend();
			}
		}
		if (isset($_POST["loginbtn"])){
			$this->logIn();
		}
		if (isset($_POST["edit"])){
			$this->edit();
		}
		if(isset($_FILES['img'])){
			$this->imageUploude();
		}
	}
	function signup(){
		$name 		= $_POST["name"];
		$surname 	= $_POST["surname"];
		$age 		= $_POST["age"];
		$email 		= $_POST["email"];
		$password 	= $_POST["password"];
		$cPassword 	= $_POST["cPassword"];
		$errors = [];
		if (empty($name)){
			$errors["name"] = "Avelacreq Name dashty";
		} 
		if (empty($surname)){
			$errors["surname"] = "Avelacreq Surname dashty";
		}
		if (empty($age)){
			$errors["age"] = "Avelacreq Age dashty";
		} else if(!filter_var($age, FILTER_VALIDATE_INT)){
			$errors["age"] = "Avelacreq chisht Tariq";
		}
		if (empty($email)){
			$errors["email"] = "Avelacreq Email dashty";
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors["email"] = "Avelacreq chisht Email";
		}
		if (empty($password)){
			$errors["password"] = "Avelacreq Password dashty";
		} else if(strlen($password)<6){
			$errors["password"] = "Password erkarutyuny karch e";
		}
		if (empty($cPassword)){
			$errors["cPassword"] = "Avelacreq Confirm Password dashty";
		} else if($password != $cPassword){
			$errors["cPassword"] = "Chisht avelacreq Confirm Password dashty";

		}
		if (count($errors)>0){
			print  json_encode($errors);
		} else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$this->db->query("INSERT INTO user(name, surname, age, email, password) VALUES('$name','$surname','$age','$email','$password')");
		}


	}
	function logIn(){
		$email = $_POST["email"];
		$password = $_POST["password"];
		$error = [];
		$data = $this->db->query("SELECT * FROM user
			WHERE email = '$email'")->fetch_all(true);
		if(empty($data)){
			$error['email'] = "Nman tvyal chka grancvac";
		}
		else{

			if(password_verify($password, $data[0]["password"])){
				$_SESSION["user"] = $data[0];
				header("location:profile.php");

			} else {
				$error["password"] = "Sxal password e mutqagrvac";
			}
		}
		if(count($error)>0){
			$_SESSION["error"] = $error;
			header("location:login.php");
		}
	}



	function edit(){
		$name 		= $_POST["name"];
		$surname 	= $_POST["surname"];
		$age 		= $_POST["age"];
		$id = $_SESSION['user']['id'];
		$this->db->query("UPDATE user SET name = '$name', surname = '$surname', age = $age WHERE id = $id ");
		$data = $this->db->query("SELECT * FROM user
			WHERE id = '$id'")->fetch_all(true);
$_SESSION["user"] = $data[0];
		header("location:profile.php");

	}

	function imageUploude(){
		$p = $_FILES["img"];
		$id = $_SESSION["user"]['id'];
			$tmp = $p["tmp_name"];
			$address = "images/".time().$p["name"];//stacvac hascen petq e pahel bazayum
			$this->db->query("UPDATE user set photo = '$address' WHERE id = $id"); 
			//update piti anenq ev avelacnenq nshvac id-ov useri photon
			if (!file_exists("images")){
				mkdir("images");
			}
			move_uploaded_file($tmp, $address);

			$_SESSION['user']['photo'] = $address;
			header('location:profile.php');
	}

	function search(){
		$search = $_POST['search'];
		$data = $this->db->query("SELECT * FROM user WHERE name LIKE '$search%'")->fetch_all(true);
		print json_encode($data);
	}

	function addFriendRequest(){
		$user_id = $_POST['id'];
		$my_id = $_SESSION['user']['id'];
		$this->db->query("INSERT INTO request (user_id, my_id) VALUES($user_id, $my_id)");


	}

	function getRequest(){
		$my_id = $_SESSION['user']['id'];
		$data = $this->db->query("SELECT * FROM request 
								JOIN user on user.id = request.my_id 
								Where user_id = $my_id")->fetch_all(true);
		print json_encode($data);
	}

	function addFriend(){
		$friend_id = $_POST['friend_id'];
		$my_id = $_SESSION['user']['id'];
		$this->db->query("INSERT INTO friends(my_id, friend_id)  VALUES($my_id, $friend_id)");
		$this->db->query("DELETE FROM request WHERE user_id = $my_id  AND my_id = $friend_id");

	}

	function deleteRequest(){
		$friend_id = $_POST['friend_id'];
		$my_id = $_SESSION['user']['id'];
		$this->db->query("DELETE FROM request WHERE user_id = $my_id  AND my_id = $friend_id");
	}

	function showFrinds(){
		$my_id = $_SESSION['user']['id'];
		$data = $this->db->query("SELECT * FROM friends 
								JOIN user on user.id = friends.my_id 
								Where my_id = $my_id")->fetch_all(true);
		print json_encode($data);
	}

	function selectFriend(){
		$friend_id = $_POST['friend_id'];
		$data = $this->db->query("SELECT * FROM friends 
								WHERE friend_id = $friend_id")->fetch_all(true);
		print json_encode($data);
	}
}
$a = new Ajax();
?>
