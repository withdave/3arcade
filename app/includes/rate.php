<?php
// Include conn settings
include("../admin/config.php");

// Get game ID (passed as gnum) and rating (rnum)
$id = intval($_GET['gnum']);
$rnum = intval($_GET['rnum']);


// Die if rating outside of bounds (1 and 5)
if ($rnum < 1 || $rnum > 5) {
  die("BAD RATING!");
}

// Build query
$query = "SELECT nov, rating FROM ".$tbprefix."games WHERE id = :id";

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
  // No error here as run through flash - so a simple note
  die("BAD RATING!");
}

// Increment the number of votes
$nov++;
// Add new rating to old rating
$rating = $rnum + $rating;

// Build update query
$query = "UPDATE ".$tbprefix."games SET rating = :rating, nov = :nov WHERE id = :id";

// Load query results
try {
  $statement = $conn->prepare($query);
  $statement->execute(array('id' => $id, 'rating' => $rating, 'nov' => $nov));
  
} catch(PDOException $e) {
  // No error here as run through flash - so a simple note
  echo 'ERROR: ' . $db_error_mode ? $e->getMessage() : $db_error_message;
  die("BAD RATING!?");
}


// Now reload the data to get the new values
// Build query
$query = "SELECT nov, rating FROM ".$tbprefix."games WHERE id = :id";

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
  // No error here as run through flash - so a simple note
  die("BAD RATING!");
}

// Calculate value for rating bar
$rating = floatval (intval($rating) / intval($nov));
$rating = round($rating / 0.5) * 0.5;
$rating = ($rating * 2) + 1;

die("&nov=".$nov."&starframe=".$rating."&upvote=true&");


?>