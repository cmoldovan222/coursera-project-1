<?php 
session_start();
$connected= !empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id'] ? TRUE : FALSE;
?>
<html>
<head> </head/>
<body>
<h1><?php echo 'Welcome to the messaging system' ?></h1>

<?php if ($connected): ?>
<h2><a href='my_sent_messages.php'>My sent Messages</a>&nbsp;/&nbsp;<a href='my_recieved_messages.php'>My recieved Messages</a>&nbsp;/&nbsp;<a href='new-message.php'>New Message</a>/&nbsp;<a href='logout-action.php'>Logout</a></h2>
<?php else: ?>
<h2><a href='login.php'>Log in</a>&nbsp;/&nbsp;<a href='register.php'>Register</a>&nbsp;/&nbsp;<a href='reset.php'>Reset Password</a></h2>

<?php endif; ?>

</body>
</html>	