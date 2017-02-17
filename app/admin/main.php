<?php
session_start();
include("config.php");

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
Frontend</a> | <a href="main.php">Admin Panel</a>
(<a href="index.php?logout=1">Logout</a>)
<h1>
Admin Panel</h1>
<p align="center"><a href="settings.php">Site Settings</a><br />
</p>
<p align="center"><a href="view.php">View all Games</a></p>
<p align="center"><a href="add.php">Add a Game</a> | <a href="delete.php">Edit/Delete a Game</a></p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
