<?php
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    if($username == 'username' && $password == 'password'){
        $_SESSION['username'] = $username;
        echo 'Login successfully';
    } else {
        echo 'Invalid Login';
    }
}
?>
