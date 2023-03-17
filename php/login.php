<?php

session_start(); // Start the session

// Include the necessary libraries
require_once('login.php');

// Initialize the MongoDB connection
$client = new MongoDB\Client('mongodb://localhost:27017');

// Initialize the Redis cache connection
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database (using Redis cache)
    $user_data = $redis->get('email');
    if ($user_data) {
        $user_data = json_decode($user_data, true);
        if ($password == $user_data['password']) {
            // User is authenticated, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            header('Location: index.php');
            exit;
        }
    }

    // User is not in the cache, check MongoDB
    $users = $client->mydatabase->users;
    $user_data = $users->findOne(['email' => $email]);
    if ($user_data) {
        if ($password == $user_data->password) {
            // User is authenticated, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            // Add user to the Redis cache
            $redis->set($email, json_encode($user_data));
            header('Location: index.php');
            exit;
        }
    }
    // If we reach here, the user is not authenticated
    $_SESSION['logged_in'] = false;
}

?>
