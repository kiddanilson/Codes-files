<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "#";
$password = "#";
$dbname = "#";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $is_business = $_POST['is_business'];
    $business_type = $_POST['business_type'];

    // Prepare SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO your_table (first_name, last_name, email, phone, region, city, is_business, business_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters to placeholders
    $bind = $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $region, $city, $is_business, $business_type);
    
    if ($bind === false) {
        die('Bind failed: ' . htmlspecialchars($stmt->error));
    }

    // Execute the prepared statement
    $execute = $stmt->execute();
    
    if ($execute === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    } else {
        // Redirect to thank you page after successful submission
        header("Location: thankyou.html");
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
