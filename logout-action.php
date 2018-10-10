<?php
session_start();

$_SESSION['connected'] = FALSE;
$_SESSION['user_id'] = 0;

header("Location:index.php");
exit();

?>