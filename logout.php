<?php
session_start();
//for developers
//echo "ID: ".$_session  echo session id

session_unset();
session_destroy();
$_SESSION= array();

header("Location:index.php");

?>