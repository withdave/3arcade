<?php

include("../admin/config.php");


$nog = "SELECT id FROM ".$tbprefix."games ORDER BY CAST(id AS SIGNED) DESC LIMIT 0,1";

$resultnog = mysql_query($nog) or die ("Problem connecting to database."); 

 $totg = mysql_result($resultnog, 0, 'id');
 
 $totg = intval($totg);


$gnum = $_GET['gnum'];

$rnum = $_GET['rnum'];

  if ($gnum != preg_replace('#[^0-9]+#i', '', $gnum)) {
 die("Error.");
 }
 
   if ($rnum != preg_replace('#[^0-9]+#i', '', $rnum)) {
 die("Error.");
 }
 
$rnum = intval($rnum);

if ($rnum < 1) {

die("BAD RATING!");

}

if ($rnum > 5) {

die("BAD RATING!");

}

if ($gnum < 1) {

die("BAD RATING!");

}

if ($gnum > $totg) {

die("BAD RATING!");

}


$rgsql = "SELECT * FROM ".$tbprefix."games WHERE id = '$gnum'";

$resultrg = mysql_query($rgsql) or die ("Problem connecting to database."); 


$nov = mysql_result($resultrg, 0, 'nov');

$nnov = $nov + 1;

$ratingold = mysql_result($resultrg, 0, 'rating');

$ratingold = intval($ratingold);

$rnum = $rnum + $ratingold;


$rgsqlx = "UPDATE ".$tbprefix."games SET rating = '$rnum', nov = '$nnov' WHERE id = '$gnum'";


$resultrgx = mysql_query($rgsqlx) or die ("Problem connecting to database."); 


$rgsql = "SELECT * FROM ".$tbprefix."games WHERE id = '$gnum'";

$resultrg = mysql_query($rgsql) or die ("Problem connecting to database."); 


$nov = mysql_result($resultrg, 0, 'nov');

$rating = mysql_result($resultrg, 0, 'rating');

$rating = floatval (intval($rating) / intval($nov));

$rating = round($rating / 0.5) * 0.5;

$rating = ($rating * 2) + 1;

die("&nov=".$nov."&starframe=".$rating."&upvote=true&");


?>