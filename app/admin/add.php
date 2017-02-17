<?php
include("config.php");
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
	header('Location: index.php');
} else {	
$pgt = $_SESSION['username'];
$pga = $_SESSION['password'];	  
if ($pgt != $admin_user) {
header('Location: index.php');
}
if ($pga != $admin_pass) {
header('Location: index.php');
}
}

//If upload...
if (isset($_POST['submit'])) {

// Get latest game id
$query = "SELECT id FROM ".$tbprefix."games ORDER BY CAST(id AS SIGNED) DESC LIMIT 0,1";
$result = mysql_query($query) or die(mysql_error()); 
$nextid = (mysql_result($result, 0, 'id')) + 1;
// Upload game thumb
$target_path = "../content/thumbnails";
$target_path = $target_path . "/".$nextid.".png"; 
if(move_uploaded_file($_FILES['thumbfile']['tmp_name'], $target_path)) {
} else {
die ("<div align=\"center\">There was an error uploading the thumbnail, please try again.<br /><br /><a href='add.php'>Back</a></div>");
}
// Upload game swf
$target_path2 = "../content";
$target_path2 = $target_path2 . "/".$nextid.".swf"; 
if(move_uploaded_file($_FILES['gamefile']['tmp_name'], $target_path2)) {
} else {
die ("<div align=\"center\" >There was an error uploading the swf, please try again! <br /><br /><a href='add.php'>Back</a></div>");
}

// Add info to database
$title = mysql_real_escape_string($_POST['title']);
$description = mysql_real_escape_string($_POST['description']);
$query = "INSERT INTO ".$tbprefix."games (id,title,description,rating,nov) VALUES ('$nextid','$title','$description',0,0)";
$result = mysql_query($query) or die ("<div align=\"center\">Problem connecting to database. <br /><br /><a href='add.php'>Back</a></div>"); 
  
// Show success!
die("<div align=\"center\">Game has been successfully added.<br /><br /><a href='add.php'>Back</a></div>");  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $settings['sitename']; ?> - Admin</title>
<link href="../includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="adminwrapper">
<a href="main.php"><img src="../includes/logo.png" alt="<?php echo $settings['sitename']; ?>" width="410" height="120" border="0" /></a><a href="../index.php"><br />
Frontend</a> | <a href="main.php">Admin Panel</a> (<a href="index.php?logout=1">Logout</a>)
<h1>Add Game</h1>
<form enctype="multipart/form-data" action="add.php" method="POST">
  <p>Thumbnail (.png | .jpg | .gif):
  <input name="thumbfile" type="file" />
    <br />
    (Thumbnail should be 70x60, or it will be scaled)</p>
  <p>Game (.swf):
  <input name="gamefile" type="file" />
    <br />
(Game should be 550x400, or it will be scaled)</p>
  <p>Game Title: 
    <label for="title"></label>
    <input name="title" type="text" id="title" size="40" />
  </p>
  <p>Game Description:<br />
    <label for="description"></label>
    <textarea name="description" id="description" cols="45" rows="5"></textarea>
  </p>
  <p>
    </p>
    <input type="submit" alt="Add Game" value="Add" border="0" name="Submit" height="17" width="40" />
    </p>
  <p><a href="main.php">Back</a></p>
</form>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
