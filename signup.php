<?php 
include 'connection.php'; 

if (isset($_POST['signup'])) {
    
    $err = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $exists = false;

    $check_user_query = "SELECT * FROM `entries` WHERE `email` = '$email'";
    $check_user_result = mysqli_query($conn, $check_user_query);
    if (mysqli_num_rows($check_user_result) > 0) {
        $exists = true;
    }

    if ($password == $cpassword && $exists == false) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `entries` (`email`, `password`) VALUES ('$email', '$hashed_password')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            header("Location: login.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
    } else {
        if ($exists) {
            echo "User already exists.";
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Authentication, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
<form action="" method="post">
    <h1>Enter Details</h1>
    <input name="email" placeholder="Enter your email" type="email" required>
    <br><br>
    <input name="password" placeholder="Enter your password" type="password" required>
    <br><br>
    <input name="cpassword" placeholder="Confirm your password" type="password" required>
    <br><br>
    <input type="submit" name="signup" value="Sign up">
</form>
<form>    
    <button><a href="login.php">Login</a></button>
</form>
</body>
</html>
