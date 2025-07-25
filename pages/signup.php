<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$db_username = "users";
$db_password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $locality = trim($_POST['locality']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($locality) || empty($password)) {
        $message = "All fields are required!";
    } else {
        // Check if email already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $message = "Email already exists, please log in.";
        } else {
            // Insert new user
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, locality, password) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("ssss", $username, $email, $locality, $password);

            if ($insert_stmt->execute()) {
                // Close connections before redirect
                $insert_stmt->close();
                $check_stmt->close();
                $conn->close();

                // Redirect to login page
                header("Location: login.php");
                exit();
            } else {
                $message = "Error: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        }

        $check_stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css" type="text/css">
</head>
<body>
    <div class="box">
        <div class="form">
            <form action="signup.php" method="POST">
                <h2>REGISTER</h2>

                <!-- Show success/error message -->
                <?php if (!empty($message)) { echo "<p style='color:red; text-align:center;'>$message</p>"; } ?>

                <!-- Username -->
                <div class="inputbox">
                    <input type="text" id="username" name="username" required>
                    <span>Name Your Account</span>
                    <i></i>
                </div>

                <!-- Email -->
                <div class="inputbox">
                    <input type="email" id="email" name="email" required>
                    <span>Enter Your Email Address</span>
                    <i></i>
                </div>

                <!-- Locality -->
                <div class="inputbox">
                    <input type="text" id="locality" name="locality" required>
                    <span>Locality</span>
                    <i></i>
                </div>

                <!-- Password -->
                <div class="inputbox">
                    <input type="password" id="password" name="password" required>
                    <span>Create a Password</span>
                    <i></i>
                </div>

                <!-- Link -->
                <div class="links">
                    <a href="login.php">Already have an account? Log in</a>
                </div>

                <!-- Submit -->
                <input type="submit" value="Signup" name="submit">
            </form>
        </div>
    </div>
</body>
</html>
