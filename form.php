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
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $satisfaction = $_POST['satisfaction'];
    $comments = $_POST['comments'];
    //Sanitize for sql injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $satisfaction = mysqli_real_escape_string($conn, $satisfaction);
    $comments = mysqli_real_escape_string($conn, $comments);

    //insert data into database
    $sql = "INSERT INTO feedback (name, email, satisfaction, comments) VALUES ('$name', '$email', '$satisfaction', '$comments')";
}

if ($conn->query($sql) === TRUE) {
    // echo "Thank you for your feedback!";
    header("Location: index.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
