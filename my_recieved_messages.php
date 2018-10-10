<?php 
session_start();

if (!empty($_SESSION['connected']) && $_SESSION['connected'] &&  !empty($_SESSION['user_id']) && $_SESSION['user_id']) {

require('database.php');
$messages = getRecievedMessages($_SESSION['user_id']);
?>
<html>
<head></head>

<body>
<h2><a href='my_sent_messages.php'>My sent Messages</a>&nbsp;/&nbsp;<a href='my_recieved_messages.php'>My recieved Messages</a>&nbsp;/&nbsp;<a href='new-message.php'>New Message</a>/&nbsp;<a href='logout-action.php'>Logout</a></h2>
<h1>My recieved Messages</h1>
<table>
<tr>
<th>No</th>
<th>Sender</th>
<th>Date/time</th>
<th>Message</th>
</tr>
<?php if (!empty($messages)): ?>
        <?php foreach($messages as $i => $message): ?>
        <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $message['username']; ?></td>
        <td><?php echo $message['datetime']; ?></td>
        <td><?php echo base64_decode($message['message']); ?></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
<table>

</body>

</html>    

<?php }else {
header('Location:index.php');
exit();
}
?>