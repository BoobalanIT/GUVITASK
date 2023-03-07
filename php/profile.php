<?php 

// Connect to the database
$db = mysqli_connect("localhost", "user", "password", "database_name");

if (isset($_POST['submit_update'])) {
    // Get the values from the form
    $firstname = $_POST['name'];
    $dob = $_POST['dob'];
    $gender =$['gender']
    $location = $_POST['location'];
   
    
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];
    
    // Update the user info in the database
    $query = "UPDATE users SET  firstname = '$name', dob= '$dob', addres  = '$location',  WHERE id = '$user_id'";
    mysqli_query($db, $query);
    
    // Redirect the user to the profile page
    header("Location: profile.php");
}

// Get the user info from the database
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);
?>