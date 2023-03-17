register page using mongodb and redis in php

<?php

$error = '';

if (isset($_POST['register'])) {
    // Connect to MongoDB
    $mongoClient = new MongoClient();
    $db = $mongoClient->test;
    $users = $db->users;
    
    // Retrieve data from the form
   
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    
    // Validate form data
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $error = 'Please fill out all fields.';
    } elseif ($password != $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        // Check if username is already taken
        $result = $users->findOne(['username' => $username]);
        if ($result) {
            $error = 'Username is already taken.';
        } else {
            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            // Create user document
            $user = [
                'username' => $username,
                'password' => $password
            ];
            
            // Add user to MongoDB
            $users->insertOne($user);
            
            // Connect to Redis
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            
            // Set user session
            $redis->hSet('users', $username, $password);
            
            // Redirect to home page
            header("Location: index.php");
        }
    }
}

?>

<form method="post">
    <?php if (!empty($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <label>Username</label>
    <input type="text" name="username" />
    <label>Email</label>
    <input type="text" name="email" />
    <label>Password</label>
    <input type="password" name="password" />
    <label>Confirm Password</label>
    <input type="password" name="confirm_password" />
    <input type="submit" name="register" value="Register" />
</form>