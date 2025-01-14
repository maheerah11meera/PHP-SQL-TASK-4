<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "review_system";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$review = $_POST['review'];

// Validate input
if (empty($name) || empty($email) || empty($review)) {
    die("All fields are required.");
}

// Securely insert data into the database
$stmt = $conn->prepare("INSERT INTO reviews (name, email, review) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $review);

if ($stmt->execute()) {
    echo "<h1>Thank you for your review!</h1>";
    echo "<a href='index.php'>Submit Another Review</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
