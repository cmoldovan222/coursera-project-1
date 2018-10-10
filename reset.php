<?php
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:home.php");
exit();
}

$error_msg = array(
'Unknown error', 
'The provided values are not valid'
);
?>

<html>
<head></head>
<body>
<h2><a href='login.php'>Log in</a>&nbsp;/&nbsp;<a href='index.php'>Home</a>&nbsp;/&nbsp;<a href='register.php'>Register</a></h2>
<h1>Reset Password</h1>
</br>
<h2 style='color:red'>
<?php if (!empty($_GET['error'])): ?>
<?php echo $error_msg[$_GET['error']]; ?>
<?php endif; ?>
</h2>

<form action='reset-action.php' method='POST'>
<table>
<tr>
<td>User:</td><td><input type='text' name='user' /></td>
</tr>
<tr>
<td>Security Question1: What was the name of your first pet?</td><td><input type='input' name='sec1' /></td>
</tr>
<tr>
<td>Security Question2: What is your favorite color?</td><td><input type='input' name='sec2' /></td>
</tr>
<tr>
<td>Security Question3: What was the name of your best friend in childhood?</td><td><input type='input' name='sec3' /></td>
</tr>
<tr>
<td></td><td><input type='submit' value='Submit' /></td>
</tr>
</table>
</form>
</body>
</html>		