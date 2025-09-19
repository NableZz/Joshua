
<?php
// Include the database connection
require 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Prepare and bind
        $stmt = $mysqli->prepare("INSERT INTO tbl_note (u_username, u_email, u_password, u_confirm) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $confirm_password);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to home.php after successful registration
            header("Location: signin.php");
            exit(); // Make sure to call exit after header to stop further execution
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NoteIt!</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <header>
        <div class="logo">
            <h1>Note<span class="highlight">It!</span></h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="register.php">REGISTER</a></li>
                <li><a href="signin.php">SIGN IN</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="image">
            <img src="https://scontent.fmnl8-1.fna.fbcdn.net/v/t1.15752-9/486054112_913065714130411_3669119300729866406_n.png?_nc_cat=108&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFee0qarGenuq97TnTdbVnuYT-s8G3lvpVhP6zwbeW-ld8d5c2rhbSd5FOE5Lxds8LCyNLakvuLgksUV5U_BqkL&_nc_ohc=-GsDhCA2gFoQ7kNvgHyKp14&_nc_oc=AdmYAwNmHY5XH567zdo2g2IqovGAbiNSMAGgocCKGWwlJMdWUxp2NuPGF2CeflHkfo8&_nc_zt=23&_nc_ht=scontent.fmnl8-1.fna&oh=03_Q7cD1wF_nvotuDJm9l5dnE42XuqUtE6rsbyGfHnyne4L76U70Q&oe=680EDC15" alt="Profile">
        </div>
        
        <div class="form-box">
            <h2>Register</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-box">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <div class="sign-up-btn">
                    <button type="submit">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>