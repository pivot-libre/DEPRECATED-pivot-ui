<?php
session_start();
$rankingsJson = getPostField("rankingsJson");
// error_log($rankingsJson);
if (!empty($rankingsJson)) { $_SESSION["rankingsJson"] = $rankingsJson; }

function getPostField($postField) {
  if (isset($_POST[$postField])) {return stripslashes($_POST[$postField]); }
  return "";
}
?>
