<?php
include_once "config.php";

//Kick off the conneciton
if (!$db = new mysqli(HOST, USER, PASSWORD)) {
  $output = "could not connect to MySQL";
}

if (!$db->set_charset('UTF8')) {
  $output = "could not select UTF8 encoding";
}

if (!$db->select_db(DATABASE)) {
  $output = "could not connect to the database (".DATABASE.")";
}

$output = "connection to ".DATABASE." successful";
?>