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

// Update settings if needed
if (isset($_POST['update'])) {
$sitename = mysql_real_escape_string($_POST['sitename']);
$homepagegames = mysql_real_escape_string($_POST['homepagegames']);
$advert1on = mysql_real_escape_string($_POST['advert1on']);
$advert1 = mysql_real_escape_string($_POST['advert1']);
$advert2on = mysql_real_escape_string($_POST['advert2on']);
$advert2 = mysql_real_escape_string($_POST['advert2']);
$metatags = mysql_real_escape_string($_POST['metatags']);
$query = "UPDATE ".$tbprefix."config SET sitename='$sitename', homepagegames='$homepagegames', advert1on='$advert1on', advert1='$advert1', advert2on='$advert2on', advert2='$advert2', metatags='$metatags'";
$result = mysql_query($query) or die(mysql_error());
header('Location: settings.php');
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
<h1>Site Settings</h1>
<form id="form1" name="form1" method="post" action="">
  <label for="sitename"></label>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left">Site Name</td>
      <td align="left"><input name="sitename" type="text" id="sitename" value="<?php echo $settings['sitename']; ?>" size="40" /></td>
    </tr>
    <tr>
      <td align="left">Number of Games on Home Page</td>
      <td align="left"><label for="homepagegames"></label>
      <input name="homepagegames" type="text" id="homepagegames" value="<?php echo $settings['homepagegames']; ?>" size="5" maxlength="4" /></td>
    </tr>
    <tr>
      <td align="left">Enable top play advert (1 = enabled, 0 = disabled)</td>
      <td align="left"><label for="advert1on"></label>
      <input name="advert1on" type="text" id="advert1on" value="<?php echo $settings['advert1on']; ?>" size="2" maxlength="1" /></td>
    </tr>
    <tr>
      <td align="left">Top Play Advert Code</td>
      <td align="left"><label for="advert1"></label>
        <label for="advert1"></label>
      <textarea name="advert1" id="advert1" cols="45" rows="5"><?php echo $settings['advert1']; ?></textarea></td>
    </tr>
    <tr>
      <td align="left">Enable bottom play advert (1 = enabled, 0 = disabled)</td>
      <td align="left"><label for="advert2on"></label>
      <input name="advert2on" type="text" id="advert2on" value="<?php echo $settings['advert2on']; ?>" size="2" maxlength="1" /></td>
    </tr>
    <tr>
      <td align="left">Bottom Play Advert Code</td>
      <td align="left"><label for="advert2"></label>
      <textarea name="advert2" id="advert2" cols="45" rows="5"><?php echo $settings['advert2']; ?></textarea></td>
    </tr>
    <tr>
      <td align="left">Site Additional Meta Tags</td>
      <td align="left"><label for="metatags"></label>
      <textarea name="metatags" id="metatags" cols="45" rows="5"><?php echo $settings['metatags']; ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right"><input type="submit" name="update" id="update" value="Update" /></td>
    </tr>
  </table>
</form>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
