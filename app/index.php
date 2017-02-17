<?php
// Include config file
include("admin/config.php");
// How many ACTIVE games in db?
$query = "SELECT id, title FROM ".$tbprefix."games LIMIT 0, ".$settings['homepagegames'];
$activegamedata = mysql_query($query) or die(mysql_error()); 
$activegamenum = mysql_numrows($activegamedata);
// Put games into array and shuffle
$array = array();
while ($row = mysql_fetch_assoc($activegamedata)) { $array[] = $row; } shuffle($array);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
// Show your defined meta tags
echo $settings['metatags']; 
?>
<META NAME="revisit-after" CONTENT="2">
<META NAME="distribution" CONTENT="global">
<title><?php echo $settings['sitename']; ?>- Random Games</title>
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("includes/header.php"); ?>
<div id="gamelist">
<?php
// Display shuffled array, limited by homepage limit
for ($i=0;$i<$settings['homepagegames'];$i++){
?>
<a title="<?php echo $array[$i]['title']; ?>" href="play.php?id=<?php echo $array[$i]['id']; ?>&n=<?php echo $array[$i]['title']; ?>"><img src="content/thumbnails/<?php echo $array[$i]['id']; ?>.png" alt="<?php echo $array[$i]['title']; ?>" width="70" height="60" border="0" /></a> 
<?php
}
?>
</div>
<p align="center">Showing a random selection of games.</p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</body>
</html>