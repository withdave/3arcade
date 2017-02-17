<?php
// Include config file
include("admin/config.php");

// How many ACTIVE games in db?
$query = "SELECT id, title FROM ".$tbprefix."games";
$activegamedata = mysql_query($query) or die(mysql_error()); 
$activegamenum = mysql_numrows($activegamedata);
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
<title><?php echo $settings['sitename']; ?> - All Games</title>
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include("includes/header.php"); ?>
<div id="gamelist">
<?php
// Display all active games
$i = 0;
while ($i < $activegamenum) {
	$title = mysql_result($activegamedata, $i, "title");
	$id = mysql_result($activegamedata, $i, "id");
	?>
  <a title="<?php echo $title; ?>" href="play.php?id=<?php echo $id; ?>&n=<?php echo $title; ?>"><img src="content/thumbnails/<?php echo $id; ?>.png" alt="<?php echo $title; ?>" width="70" height="60" border="0" /></a> 
	<?php
    $i++;
} 
?>
</div>
<p align="center">Showing all <?php echo $activegamenum; ?> games.</p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</body>
</html>