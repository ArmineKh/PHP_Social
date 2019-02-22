<?php 
$password = "secretkey1990";
print md5($password)."<br>";
print password_hash($password, PASSWORD_DEFAULT);
$hash = '$2y$10$8IRepoFAYR2qiitbx4nhSOBrVsGL5ZP9.Wp1zCzYg1fgGnnoB56ii';
print "<br>";
if(var_dump(password_verify($password, $hash))){
	
}


 ?>