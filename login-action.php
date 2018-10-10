<?php
session_start();
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:home.php");
exit();
}

require('database.php'); 

function errorRedirect($error) {
header("Location:login.php?error=" . $error);
exit();
}

if (!empty($_POST['user']) && !empty($_POST['password']) ) {
    if (login($_POST['user'], $_POST['password']) ) {
        header("Location:index.php");
        exit();
    } else {
           errorRedirect(1); 
     }
} else {
   errorRedirect(2);    
}

?>						