<?php
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {

require('database.php'); 

function errorRedirect($error) {

header("Location:new-message.php?error=" . $error);
exit();

}

if (!empty($_POST['user']) && !empty($_POST['message'])) {
    if (newMessage($_SESSION['user_id'],$_POST['user'],$_POST['message']) ) {
        header("Location:my_sent_messages.php?error=1");
        exit();        
    } else {
       errorRedirect(0);    
    }
} else {
    errorRedirect(1);    
}

} else {
header("Location:index.php");
exit();
}
?>