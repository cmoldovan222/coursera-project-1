<?php
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:home.php");
exit();
}

require('database.php'); 

function errorRedirect($error) {
header("Location:reset.php?error=" . $error);
exit();
}

if (!empty($_POST['user']) && !empty($_POST['sec1']) && !empty($_POST['sec2']) && !empty($_POST['sec3']) ) {
    if ($token = validateSec($_POST['user'], array($_POST['sec1'],$_POST['sec2'],$_POST['sec3']))) {
        echo 'You new password is: '. $token . '</br><a href="index.php">HOME</a>';        

    } else {
           errorRedirect(1); 
     }
} else {
   errorRedirect(1);    
}

?>								