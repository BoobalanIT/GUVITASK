
<?php

if (isset($_POST['register'])) {
    
    // get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // check if the passwords match
    if ($password !== $confirmPassword) {
        die('Passwords do not match');
    }
    
    // hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // register the user in the database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    $result = mysqli_query($db, $query);
    
    if ($result) {
        // user has been registered
        // redirect to the main page
        header('Location: main.php');
    } else {
        // something went wrong
        die('Error registering user');
    }
}

?>