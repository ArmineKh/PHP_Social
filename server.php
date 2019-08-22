<?php 
class Ajax{ 
	private  $db;
	function __construct(){
		session_start(); 
		$this->db = new mysqli("localhost", "root", "", "db");
		if (isset($_POST["action"])){
			$action = $_POST['action'];
			call_user_func([$this,$action]);
		} 
			if (isset($_POST["logInbtn"])){
				print 25;
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
		$this->db->query("UPDATE user SET name = '$name', surname = '$surname', age = $age 
			WHERE id = $id ");
		$data = $this->db->query("SELECT * FROM user
			WHERE id = '$id'")->fetch_all(true);
		$_SESSION["user"] = $data[0];
		header("location:profile.php");
 
	}

	function imageUploude(){
		$p = $_FILES["img"];
		$id = $_SESSION["user"]['id'];
		$tmp = $p["tmp_name"];
		$address = "images/".time().$p["name"];
		$this->db->query("UPDATE user set photo = '$address' WHERE id = $id"); 
		if (!file_exists("images")){
			mkdir("images");
		}
		move_uploaded_file($tmp, $address);

		$_SESSION['user']['photo'] = $address;
		header('location:profile.php'); 
	}

	function search(){
		$id = $_SESSION["user"]['id'];
		$search = $_POST['search'];
		$data = $this->db->query("SELECT * FROM user WHERE name LIKE '$search%'")->fetch_all(true);
		$arr = [];
		foreach ($data as $key ) {

			$user_id = $key['id'];
			$req = $this->db->query("SELECT * FROM request WHERE my_id = $id and user_id = $user_id")->fetch_all(true);
			$friend = $this->db->query("SELECT * FROM friends WHERE (my_id = $id and friend_id = $user_id) or (my_id = $user_id and friend_id = $id)")->fetch_all(true);

			if ($id==$user_id) {
				$key['status']	= 3;				
			}
			elseif (!empty($req)) {
				$key['status']	= 2;				
			}
			elseif (!empty($friend)) {
				$key['status']	= 1;				
			}
			else{
				$key['status']	= 0;				

			}

			$arr[]=$key;
		}
		print json_encode($arr);
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
		$data = $this->db->query("SELECT * FROM user WHERE id in 
			(SELECT friend_id from friends where my_id = $my_id
			union 
			select my_id from friends where friend_id = $my_id) ")->fetch_all(true);
		print json_encode($data);
	}

	function selectFriend(){
		$friend_id = $_POST['friend_id'];
		$my_id = $_SESSION['user']['id'];
		$data = $this->db->query("SELECT * FROM user WHERE id in 
			(SELECT friend_id from friends where my_id = $my_id
			union 
			select my_id from friends where friend_id = $my_id) and id=$friend_id ")->fetch_all(true);
		print json_encode($data);
	}

	function sendMessage(){
		$friend_id =  $_POST['friend_id'];
		$my_id = $_SESSION['user']['id'];
		$message =  mysqli_real_escape_string($this->db, $_POST['message']);;
		$this->db->query("INSERT INTO message(my_id, friend_id, message) VALUES($my_id, $friend_id, '$message')");
	}

	function getMessage(){
		$friend_id = $_POST['friend_id'];
		$my_id = $_SESSION['user']['id'];
		$data = $this->db->query("SELECT *  from message where friend_id = $friend_id or friend_id = $my_id")->fetch_all(true);
		print json_encode($data);
	}

	function addStatus(){
		$status = $_POST['status'];
		$my_id = $_SESSION['user']['id'];
		$this->db->query("INSERT INTO status(my_id, status) VALUES($my_id, '$status')");
	}

	function showStatus(){
		$my_id = $_SESSION['user']['id'];
		$data = $this->db->query("SELECT status.*,user.name,user.surname,user.photo  from status join user on user.id = status.my_id where my_id = $my_id or my_id in 
			(SELECT friend_id from friends where my_id = $my_id
			union 
			select my_id from friends where friend_id = $my_id) order by time desc")->fetch_all(true);
		$arr = [];
		foreach ($data as $key ) {
			$post_id=$key['id'];
			$key['likes'] = $this->db->query("SELECT user.* from `like`
				join user on user.id = `like`.my_id
				WHERE post_id = $post_id")->fetch_all(true);
			$key['comment'] = $this->db->query("SELECT user.*,comment.comment from `comment`
				join user on user.id = `comment`.my_id
				WHERE post_id = $post_id")->fetch_all(true);
			$arr[]=$key;
		}
		print json_encode($arr);
	}

	function addlike(){
		$my_id = $_SESSION['user']['id'];
		$post_id = $_POST['post_id']; 
		$this->db->query("INSERT INTO `like`(my_id, post_id) VALUES($my_id, $post_id)");

	}

	function addComment(){
		$my_id = $_SESSION['user']['id'];
		$post_id = $_POST['post_id'];
		$comment = $_POST['comment'];
		$this->db->query("INSERT INTO comment(post_id, comment, my_id) VALUES($post_id, '$comment', $my_id)");		
	}

	function showFriend(){
		$friend_id = intval($_POST['fr_id']);
		$data = $this->db->query("SELECT * FROM user 
			WHERE id = $friend_id")->fetch_all(true);
		print json_encode($data);
	}

	function showFrPhoto(){
		$friend_id = $_POST['fr_id'];
		$data = $this->db->query("SELECT photos FROM photos
			join user on user.id = photos.user_id 
			WHERE user_id = $friend_id")->fetch_all(true);
		print json_encode($data);	
	}

	function showFrStatus(){
		$friend_id = $_POST['fr_id'];
		$data = $this->db->query("SELECT status.*,user.name,user.surname,user.photo  from status join user on user.id = status.my_id where my_id = $friend_id  order by time desc")->fetch_all(true);
		$arr = [];
		foreach ($data as $key ) {
			$post_id=$key['id'];
			$key['likes'] = $this->db->query("SELECT user.* from `like`
				join user on user.id = `like`.my_id
				WHERE post_id = $post_id")->fetch_all(true);
			$key['comment'] = $this->db->query("SELECT user.*,comment.comment from `comment`
				join user on user.id = `comment`.my_id
				WHERE post_id = $post_id")->fetch_all(true);
			$arr[]=$key;
		}
		print json_encode($arr);
	}

	function showFrFrends(){
		$friend_id = $_POST['fr_id'];
		$data = $this->db->query("SELECT friends.*,user.name,user.surname,user.photo FROM friends 
								join user on user.id = friends.my_id where friends.my_id = $friend_id")->fetch_all(true);
		print json_encode($data);
	}

}

$a = new Ajax();
?>
