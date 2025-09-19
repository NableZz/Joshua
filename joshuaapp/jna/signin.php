<?php
// Include the database connection
require 'db.php';

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT u_password FROM tbl_note WHERE u_username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if ($password === $hashed_password) { // Use password_verify() if passwords are hashed
            // Set session variables or any other logic
            $_SESSION['username'] = $username;

            // Redirect to noteit.php
            header("Location: noteit.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('Username not found!');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="sign.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <div class="wrapper">
        <div class="main-container">
            <div class="nav-container">
                <header class="header">
                    <h2>Note<span>It!</span></h2>
                    <nav class="navbar">
                        <a href="home.php">HOME</a>
                        <a href="register.php">REGISTER</a>
                        <a href="signin.php">SIGN IN</a>
                    </nav>
                </header>
            </div>

            <form action="" method="POST">
                <h1>Note<span>It!</span></h1>
                <div class="input-box">
                    <h3>Username</h3>
                    <input type="text" name="username" placeholder="Username" required />
                </div>

                <div class="input-box">
                    <h3>Password</h3>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox"/> Sign Me In</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn">SIGN IN</button>
            </form>
        </div>
    </div>
</body>
</html>
