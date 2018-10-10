<?php
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:index.php");
exit();
}
require('database.php'); 

function errorRedirect($error) {

header("Location:register.php?error=" . $error);
exit();

}

if (!empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['password2'])  && !empty($_POST['sec1']) && !empty($_POST['sec2']) && !empty($_POST['sec3'])) {
    if (strlen($_POST['password']) < 8) {
        errorRedirect(4);
    } elseif ($_POST['password'] != $_POST['password2']) {
        errorRedirect(2);
    } elseif (userExists($_POST['user'])) { /// need to check if user exists
        errorRedirect(1);
    } else {
        if (newUser($_POST['user'],$_POST['password'],array($_POST['sec1'],$_POST['sec2'],$_POST['sec3'])) ) {
            login($_POST['user'],$_POST['password']);
            header("Location:index.php");
             exit();
         } else {
            errorRedirect(0);
        }
    }
} else {
errorRedirect(2);    
}


?>					