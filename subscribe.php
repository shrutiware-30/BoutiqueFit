<?php
$servername = "localhost";
$username = "root";
$password = "mypass";
$database = "tailor_shop"; // Change this to your actual database name

// Create connection
$conn = new  mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//retrive form data
if (isset($_POST['subscribe'])) {
    $email = $_POST['email'];
    //Sanitize for sql injection
    $email = mysqli_real_escape_string($conn, $email);

    //insert data into database
    $sql = "INSERT INTO subscribe (email) VALUES ('$email')";
}

if ($conn->query($sql) === TRUE) {
    echo "Thank you for your feedback!";
    header("Location: index.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
