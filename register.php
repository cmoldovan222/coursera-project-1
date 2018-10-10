<?php
session_start();
if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {
header("Location:home.php");
exit();
}

$error_msg = array(
'Unknown error', 
'User already exists',
'The two passwords do not match',
'You didn\'t complete all fields',
'Password too short'
);
?>

<html>
<head></head>
<body>
<h2><a href='login.php'>Log in</a>&nbsp;/&nbsp;<a href='index.php'>Home</a></h2>
<h1>Register</h1>
</br> Password should have at least 8 characters
</br>
<h2 style='color:red'>
<?php if (!empty($_GET['error'])): ?>
<?php echo $error_msg[$_GET['error']]; ?>
<?php endif; ?>
</h2>

<form action='register-action.php' method='POST'>
<table>
<tr>
<td>User:</td><td><input type='text' name='user' /></td>
</tr>
<tr>
<td>Password:</td><td><input type='password' name='password' /></td>
</tr>
<tr>
<td>Retype Password:</td><td><input type='password' name='password2' /></td>
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