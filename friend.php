<?php 
session_start();
if (!isset($_SESSION['user'])){
	header('location:index.php');
} else{

}


?>
<?php include_once('header.php'); ?>
<input type="hidden" id="fr_id" value="<?=$_GET['id'] ?>">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">trrt...</div>
  <div class="tab-pane container fade" id="menu1">.rrrrr..</div>
  <div class="tab-pane container fade" id="menu2">.ttttr..</div>
</div>
</body>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/friend.js"></script>
</html>