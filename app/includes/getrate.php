<?php
// Include conn settings
include("../admin/config.php");

// Get game ID (passed as gnum)
$id = intval($_GET['gnum']);

// Build query
$query = "SELECT * FROM ".$tbprefix."games WHERE id = :id";

// Load query results
try {
  $statement = $conn->prepare($query);
  $statement->execute(array('id' => $id));
  // Use fetch to pick up first row
  $result = $statement->fetch();

  // Get number of votes
  $nov = $result['nov'];
  // Get rating
  $rating = $result['rating'];
  
} catch(PDOException $e) {
  die('ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message);
}

// Calculate actual rating (rating divided by number of ratings)
$rating = floatval (intval($rating) / intval($nov));
$rating = round($rating / 0.5) * 0.5;
$rating = ($rating * 2) + 1;

// Exit, printing data for rating bar
die("&nov=".$nov."&starframe=".$rating."&gotrate=true&");


?>