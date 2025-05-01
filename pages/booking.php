<?php
// Configuration
$db_host = 'localhost';
$db_username = 'bookingss';
$db_password = '';
$db_name = 'booking_system';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Insert data into database
    $sql = "INSERT INTO bookingss (name, email, checkin, checkout) VALUES ('$name', '$email', '$checkin', '$checkout')";
    if ($conn->query($sql) === TRUE) {
        echo "Thank you for booking, $name! We will contact you at $email.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
