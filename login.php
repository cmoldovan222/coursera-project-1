<?
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:home.php");
exit();
}

$error_msg = array(
'Unknown error',
'Invalid user and/or password',
'You didn\'t complete all fields',
);
?>

<html>
<head><title>Log In</title></head>
<body>
<h2><a href='index.php'>Home</a>&nbsp;/&nbsp;<a href='register.php'>Register</a></h2>
<h1>Log In</h1>
<h2 style='color:red'>
<?php if (!empty($_GET['error'])): ?>
<?php echo $error_msg[$_GET['error']]; ?>
<?php endif; ?>
</h2>
<form action='login-action.php'method="POST">
<table>
<tr>
<td>User:</td><td><input type='text' name='user' /></td>
</tr>
<tr>
<td>Password:</td><td><input type='password' name='password' /></td>
</tr>
<tr>
<td></td><td><input type='submit' value='Submit' /></td>
</tr>
</table>
</form>

</body>

</html>			