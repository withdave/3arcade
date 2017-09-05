<?php
session_start();
include("config.php");

// Check to see if access valid and redirect as appropriate
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
	header('Location: index.php');
} else {
	$pgt = $_SESSION['username'];
	$pga = $_SESSION['password'];
	if ($pgt != $admin_user || $pga != $admin_pass) {
		header('Location: index.php');
	}
}

// Set empty error log
$elog = "";

// Load error messages (sent back from delete2.php)
$er = $_GET['er'];
if ($er == "inv") {
  $elog = "Not a valid game id.";
}
if ($er == "ex") {
  $elog = "Game does not exist.";
}
if ($er == "updated") {
  $elog = "Game was successfully updated/deleted.";
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
<h1>Edit/Delete Game</h1>
<form id="delete" name="delete" method="post" action="delete2.php">
<p align="center">Game ID: 
  <input name="gid" class="inputtext" type="text" value="<?php
  $pgid = "";
  $pgid = $_GET['pgid'];
  if ($pgid != "") {
  echo $pgid;
  }
   ?>">
  <br />
  (This should be a number)</p>
<p align="center">
  <input class="submitbutton1" type="submit" alt="View Game" value="View" border="0" name="submit" height="17" width="40" />
</p><?php   
if ($elog != "") {
echo '<br />'.$elog;
}
 ?>
<p align="center"><a href="main.php">Back</a></p>
</form>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
