<?php

session_start();
include("admin/config.php");

// Check for requested game id
$id = ereg_replace("[^0-9]", "", $_GET['id']);
// If no game id, go to random game
if ($id == "") {
	header("Location: play.php?id=0");
} 
// If game id is 0, logic finds another game
elseif ($id == 0) {
	$lastid = ereg_replace("[^0-9]", "", $_GET['lastid']);
	if ($lastid != "") {
		$query = "SELECT id, title FROM ".$tbprefix."games WHERE id != ".$lastid." ORDER BY RAND() LIMIT 1";
	} else {
		$query = "SELECT id, title FROM ".$tbprefix."games ORDER BY RAND() LIMIT 1";
	}
	$result = mysql_query($query) or die(mysql_error());
	$newid = mysql_result($result, 0, "id");
	$newtitle = mysql_result($result, 0, "title");
	header("Location: play.php?id=".$newid."&n=".$newtitle);
}

// Get requested game details if the id is valid & not random
$query = "SELECT title, description, plays FROM ".$tbprefix."games WHERE id=".$id." ";
$result = mysql_query($query);
$title = mysql_result($result, 0, "title");
$description = mysql_result($result, 0, "description");
$plays = mysql_result($result, 0, "plays");
// Increment the play counter
$newplays = $plays + 1;
$query = "UPDATE ".$tbprefix."games SET plays=".$newplays." WHERE id=".$id." ";
$result = mysql_query($query) or die(mysql_error());

// Get admin details, check for login
$adminlog = false;
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
$adminlog = true;
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
// Show your defined meta tags
echo $settings['metatags']; ?>
<META NAME="revisit-after" CONTENT="2">
<META NAME="distribution" CONTENT="global">
<title><?php echo $settings['sitename']; ?> - Gameplay: <?php echo $title; ?></title>
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script src="includes/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="includes/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<?php
// Include header
include("includes/header.php");
if ($settings['advert1on']) { ?>
<div id="advert">
<?php echo $settings['advert1']; ?>
</div>
<?php } ?>
<div id="gamecontainer">
  <div id="gameleft">

  <object id="game" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="550" height="400">
    <param name="movie" value="content/<?php echo $id; ?>.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.0.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
    <param name="expressinstall" value="includes/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="content/<?php echo $id; ?>.swf" width="550" height="400">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.0.0" />
      <param name="expressinstall" value="includes/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
</object>
</div>
  <div id="rightcontainer">
  <div id="gameright">
    <h1><?php echo $title; ?>:</h1>
    <p><?php echo $description; ?></p>
  </div>
    <div id="gametools">
      <div align="center">
        <p>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="127" height="56" align="bottom" id="FlashID">
            <param name="movie" value="includes/rate.swf?g=<?php echo $id; ?>" />
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="6.0.65.0" />
            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
            <param name="expressinstall" value="includes/expressInstall.swf" />
            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
            <!--[if !IE]>-->
            <object data="includes/rate.swf?g=<?php echo $id; ?>" type="application/x-shockwave-flash" width="127" height="56" align="bottom">
              <!--<![endif]-->
              <param name="quality" value="high" />
              <param name="wmode" value="opaque" />
              <param name="swfversion" value="6.0.65.0" />
              <param name="expressinstall" value="includes/expressInstall.swf" />
              <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
              <div>
                <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
              </div>
              <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
          </object>
        </p>
        <p>Played <?php echo $newplays; ?> times</p>
      </div>
    </div>
  <div id="gametools">
    <h1>Options:</h1>
    <p><a href="play.php?id=0&amp;lastid=<?php echo $id; ?>">Play a Random Game</a>    </p>
    <p><!-- AddThis Button BEGIN -->
  <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=sourcez"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=sourcez"></script>
<!-- AddThis Button END -->
</p>
    <?php 
// If admin is logged in, show game controls
if ($adminlog == true) {
echo "<p><a href='admin/delete.php?pgid=".$_GET['id']."'>- Edit/Delete game</a></p>";
}
?>
  </div>
  </div>
  <div id="clear"></div>
</div>
<?php
if ($settings['advert2on']) { ?>
<div id="advert">
<?php echo $settings['advert2']; ?>
</div>
<?php } ?>
<br />
<?php 
// If not, show any adverts setup
$advert_code = stripslashes($advert_code);
echo $advert_code;
?>
</p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
<script type="text/javascript">
swfobject.registerObject("game");
swfobject.registerObject("FlashID");
</script>
</body>
</html>
