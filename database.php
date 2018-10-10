<?php
session_start();

function getConnection() {
    
$servername = "sql110.epizy.com";
$username = "epiz_22816227";
$password = "mjJNn5nfuAvQiZp";
$db = 'epiz_22816227_coursera';

// Create connection
return new mysqli($servername, $username, $password, $db);
}

function login($user, $pass) {
    
  $connection = getConnection();
  // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
    
        $user = mysqli_real_escape_string($connection, $user);
        $pass = md5(mysqli_real_escape_string($connection, $pass));
    
        $sql = "SELECT id FROM Users WHERE 
        username = '" . $user . "' AND password = '" . $pass . "'";

        $result = $connection->query($sql);
        $connection->close();        
        
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 $_SESSION['connected'] = TRUE;
                 $_SESSION['user_id'] = $row["id"];
               
                return TRUE;
             }                 

        } else {
            return FALSE;
        }
    }
}

function validateSec($user, $secQ) {
    
  $connection = getConnection();
  // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
    
        $user = mysqli_real_escape_string($connection, $user);
        $security = md5($secQ[0]).'-'.md5($secQ[1]). '-'.md5($secQ[2]);
    
        $sql = "SELECT id FROM Users WHERE 
        username = '" . $user . "' AND SecQ = '" . $security . "'";

        $result = $connection->query($sql);
        
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {           
                $token = generateRandomString(10); 
                
            $sql2 = "UPDATE Users set password='".md5($token)."' WHERE 
                username = '" . $user . "' AND SecQ = '" . $security . "'";                
            $connection->query($sql2);

                $connection->close();        
                return $token;
                
             }                 
        } else {
            $connection->close();        
            return FALSE;
        }
    }    
    
}

function newUser($user, $pass, $secQ) {

  $connection = getConnection();
  // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        
        $user = mysqli_real_escape_string($connection, $user);
        $pass = md5(mysqli_real_escape_string($connection, $pass));
        $security = md5($secQ[0]).'-'.md5($secQ[1]). '-'.md5($secQ[2]);
        
        $sql = "INSERT INTO Users (username, password, SecQ)
        VALUES ('" . $user . "', '" . $pass . "','" . $security . "')";

        if ($connection->query($sql) === TRUE) {
           return TRUE;
        } else {
            return FALSE;
        }
        
        $connection->close();        
    }
}

function getAllUsers() {
    
    $users = array();
    
    $connection = getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
      
        $sql = "SELECT id,username FROM Users ";

        $result = $connection->query($sql);
        $connection->close();        
        
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                    $users[$row['id']] = $row['username'];      
             }                 
        } 
    }   
        return $users;
}

function userExists($user) {
    $connection = getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        
        $user = mysqli_real_escape_string($connection, $user);
        $sql = "SELECT id FROM Users WHERE username = '" . $user . "'";
        
        $result = $connection->query($sql);
        $connection->close();        
        
        if ($result->num_rows > 0) {
            return TRUE;             
        } 
    }   
        return FALSE;
}

function getSentMessages($id) {
    $messages = array();
    
    $connection = getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
      
        $sql = "SELECT Messages.message, Messages.datetime, Users.username FROM Messages LEFT JOIN Users ON Messages.reciever = Users.id WHERE Messages.sender =".$id;

        $result = $connection->query($sql);
        $connection->close();        
        
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                $messages[] = $row;     
             }                 
        } 
    }   
    return $messages;
}

function getRecievedMessages($id) {
    $messages = array();
    
    $connection = getConnection();
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
      
        $sql = "SELECT Messages.message, Messages.datetime, Users.username FROM Messages LEFT JOIN Users ON Messages.sender = Users.id WHERE Messages.reciever =".$id;

        $result = $connection->query($sql);
        $connection->close();        
        
        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                $messages[] = $row;     
             }                 
        } 
    }   
    return $messages;
}

function newMessage($sender, $reciever, $message) {
      $connection = getConnection();
  // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
        
        $sender = (int)$sender;
        $reciever = (int)$reciever;
        $message = base64_encode($message);
        //$message = mysqli_real_escape_string($connection, $message);
        
        $sql = "INSERT INTO Messages (sender, reciever, message)
        VALUES ('" . $sender . "', '" . $reciever . "', '" . $message . "')";

        if ($connection->query($sql) === TRUE) {
            $connection->close();        
            return TRUE;
        } 
        $connection->close();        
        return false;        
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>						