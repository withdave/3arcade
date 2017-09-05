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

// Check to see if delete submitted, redirect if ID invalid format
if (isset($_POST['delete'])) {
  $id = intval($_POST['gid']);
  if ($id == 0) {
    header('Location: delete.php?er=inv');
  }

  // Find in db
  $query = "SELECT id FROM ".$tbprefix."games WHERE id = :id";

  // Load query results
  try {
    $statement = $conn->prepare($query);
    $statement->execute(array('id' => $id));
    // Use fetch to pick up first row
    $result = $statement->fetch();
    
  } catch(PDOException $e) {
    echo 'ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message;
  }

  // Count rows returned
  if ($statement->rowCount() != 1) {
    header('Location: delete.php?er=ex');
  }

  // Delete png and swf
  $myFile = "../content/thumbnails/".$id.".png";
  unlink($myFile);
  $myFile = "../content/".$id.".swf";
  unlink($myFile);

  // Delete game from database
  $query = "DELETE FROM ".$tbprefix."games WHERE id=:id";
  // Load query results
  try {
    $statement = $conn->prepare($query);
    $statement->execute(array('id' => $id));
    
  } catch(PDOException $e) {
    die('ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message);
  }
  
  // Display successful message
  die("<div align=\"center\">Game successfully deleted.<br /><br /><a href='delete.php'>Back</a></div>");
}

// If update...
if (isset($_POST['update'])) {
  $id = intval($_POST['gid']);
  if ($id == 0) {
    header('Location: delete.php?er=inv');
  }

  // Find in db
  $query = "SELECT id FROM ".$tbprefix."games WHERE id = :id";
  // Load query results
  try {
    $statement = $conn->prepare($query);
    $statement->execute(array('id' => $id));
    // Use fetch to pick up first row
    $result = $statement->fetch();
    
  } catch(PDOException $e) {
    echo 'ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message;
  }
  
  if ($statement->rowCount() != 1) {
    header('Location: delete.php?er=ex&pgid='.$id);
  }

  // Update db
  $query = "UPDATE ".$tbprefix."games SET title=:title, description=:description WHERE id=:id";
  // Load query results
  try {
    $statement = $conn->prepare($query);
    $statement->execute(array('title' => $_POST['title'],
                              'id' => $id,
                              'description' => $_POST['description']));
    
  } catch(PDOException $e) {
    die('ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message);
  }
 
  header('Location: delete.php?er=updated&pgid='.$id);
}

// If view (sent from delete.php)
if (isset($_POST['submit'])) {
  $id = intval($_REQUEST['gid']);
  if ($id == 0) {
    header('Location: delete.php?er=inv');
  }

  // Find in db
  $query = "SELECT id, title, description FROM ".$tbprefix."games WHERE id = :id";
  // Load query results
  try {
    $statement = $conn->prepare($query);
    $statement->execute(array('id' => $id));
    // Use fetch to pick up first row
    $result = $statement->fetch();

    $title = $result['title'];
    $description = $result['description'];
    
  } catch(PDOException $e) {
    echo 'ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message;
  }
  
  if ($statement->rowCount() != 1) {
    header('Location: delete.php?er=ex');
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $settings['sitename']; ?> - Admin</title>
<link href="../includes/style.css" rel="stylesheet" type="text/css">
<script src="../includes/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="../includes/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<div id="adminwrapper">
<a href="main.php"><img src="../includes/logo.png" alt="<?php echo $settings['sitename']; ?>" width="410" height="120" border="0" /></a><a href="../index.php"><br />
Frontend</a> | <a href="main.php">Admin Panel</a> (<a href="index.php?logout=1">Logout</a>)
<h1>Edit/Delete Game</h1>
<form id="form1" name="form1" method="post" action="delete2.php?gid=<?php echo $gid; ?>">
<p align="center"><strong>Game <?php echo $gid; ?>:</strong> 
  <label for="title"></label>
  <input name="title" type="text" id="title" value="<?php echo $title; ?>" />
<p align="center"><strong>Description:</strong> 
  <br />
  <label for="description"></label>
  <textarea name="description" id="description" cols="45" rows="5"><?php echo $description; ?></textarea>
<p align="center">
    <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="550" height="400">
      <param name="movie" value="../content/<?php echo $id; ?>.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.0.0" />
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don�t want users to see the prompt. -->
      <param name="expressinstall" value="../includes/expressInstall.swf" />
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../content/<?php echo $id; ?>.swf" width="550" height="400">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="6.0.0.0" />
        <param name="expressinstall" value="../includes/expressInstall.swf" />
        <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
        <div>
          <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
          </div>
        <!--[if !IE]>-->
        </object>
      <!--<![endif]-->
  </object>
  <p align="center">
  <input name="gid" type="hidden" id="gid" value="<?php echo $id; ?>" />
  <input type="submit" name="update" id="update" value="Update Game" />
  </p>
  <p align="center">or</p>
  <p align="center">
    <input type="submit" alt="Delete Game" value="Delete Permanently" name="delete" height="17" width="40" />
  </p>
</form>
<p align="center"><a href="delete.php">Back</a></p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>
