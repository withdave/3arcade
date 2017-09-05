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


// Build query for all games
$query = "SELECT id, title, description FROM ".$tbprefix."games ";
// Load query results
try {
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    
} catch(PDOException $e) {
  echo 'ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message;
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
<h1>View All Games</h1>
<table width="700" border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td width="40"><strong>ID</strong></td>
    <td width="60"><strong>Thumb</strong></td>
    <td width="200"><strong>Title</strong></td>
    <td width="325"><strong>Description</strong></td>
    <td width="75"><strong>Options</strong></td>
  </tr>
  <?php
  $i = 0;
  foreach($result as $row) {
    $title = $row['title'];
    $description = $row['description'];
    $id = $row['id'];
    $i++;
    ?>
  <tr>
    <td><?php echo $id; ?></td>
    <td><img src="../content/thumbnails/<?php echo $id; ?>.png" width="60" height="50" /></td>
    <td><a href="../play.php?id=<?php echo $id; ?>&amp;n=<?php echo $title; ?>" target="_blank"><?php echo $title; ?></a></td>
    <td><?php echo $description; ?></td>
    <td><a href="delete.php?pgid=<?php echo $id; ?>">Edit/Delete</a></td>
  </tr>
  <?php
}
?>
</table>
<p>&nbsp;</p>
<p align="center" class="footer">&copy; <?php print date('Y')." ".$settings['sitename']; ?><br />All games &copy; their original owners.</p>
</div>
</body>
</html>
