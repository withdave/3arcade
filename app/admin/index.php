<?php
//Check if logged in
session_start();
include("config.php");
if ($_GET['logout']) {
session_unset();
header('Location: index.php');
}
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
} else {
	if(!get_magic_quotes_gpc()) {
		$_SESSION['username'] = addslashes($_SESSION['username']);
		$_SESSION['password'] = addslashes($_SESSION['password']);
	}
	$pgt = $_SESSION['username'];
$pga = $_SESSION['password'];
if ($pgt == $admin_user) {
if ($pga == $admin_pass) {
header('Location: main.php');
}
}
}
if (isset($_POST['submit'])) {
$usr = $_POST['username'];
$pas = $_POST['password'];	  
if ($usr == $admin_user) {
if ($pas == $admin_pass) {
//Log in
session_start();	
	$_SESSION['username'] = $usr;	
	$_SESSION['password'] = $pas; 	
header('Location: main.php');
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $settings['sitename']; ?> - Admin Login</title>
<link href="../includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="adminwrapper">
<a href="main.php"><img src="../includes/logo.png" alt="<?php echo $settings['sitename']; ?>" width="410" height="120" border="0" /></a><a href="../index.php"><br />
Frontend</a>
<h1>Admin Panel Login</h1>
<form id="form1" name="form1" method="post" action="index.php">
<p align="center" class="style3">Username: <input name="username" class="inputtext" type="text" value="admin"></p>
<p align="center" class="style3">Password: <input name="password" class="inputtext" type="password" value="admin">
</p>
<p align="center"><INPUT class=submitbutton1 type=submit alt="Log In" value="Log In" border=0 name=submit height="17" width="40"><br />
</p></form>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
