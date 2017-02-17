<?php

include("../admin/config.php");


$gnum = $_GET['gnum'];

  if ($gnum != preg_replace('#[^0-9]+#i', '', $gnum)) {
 die("Error.");
 }

$rgsql = "SELECT * FROM ".$tbprefix."games WHERE id = '$gnum'";

$resultrg = mysql_query($rgsql) or die ("Problem connecting to database."); 


$nov = mysql_result($resultrg, 0, 'nov');

$rating = mysql_result($resultrg, 0, 'rating');

$rating = floatval (intval($rating) / intval($nov));

$rating = round($rating / 0.5) * 0.5;

$rating = ($rating * 2) + 1;

die("&nov=".$nov."&starframe=".$rating."&gotrate=true&");


?>