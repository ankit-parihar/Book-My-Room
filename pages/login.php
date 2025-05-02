<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$db_username = "root";
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
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Both email and password are required!";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $message = "Login successful! Welcome.";
            // You can start a session here or redirect to a dashboard
        } else {
            $message = "Invalid email or password.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css" type="text/css">
</head>
<body>
    <div class="box">
        <div class="form">
            <form action="login.php" method="POST">
                <h2>LOGIN</h2>

                <!-- Show success/error message -->
                <?php if (!empty($message)) { echo "<p style='color:red; text-align:center;'>$message</p>"; } ?>

                <!-- Email -->
                <div class="inputbox">
                    <input type="email" id="email" name="email" required>
                    <span>Email Address</span>
                    <i></i>
                </div>

                <!-- Password -->
                <div class="inputbox">
                    <input type="password" id="password" name="password" required>
                    <span>Password</span>
                    <i></i>
                </div>

                <!-- Link -->
                <div class="links">
                    <a href="signup.php">Don't have an account? Sign up</a>
                </div>

                <!-- Submit -->
                <input type="submit" value="Login" name="submit">
            </form>
        </div>
    </div>
</body>
</html>
