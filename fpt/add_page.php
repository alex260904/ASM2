<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $rollno = $_POST['id'];
    $username = $_POST['fullname'];
    $address = $_POST['Address'];
    $gender = $_POST['gender'];
    
    // Basic validation
    if (empty($rollno) || empty($username) || empty($address) || empty($gender)) {
        die("Please fill in all fields.");
    }

    // Database connection
    $hostname = "localhost";
    $db_username = "root"; // Renamed to avoid variable overwriting
    $db_password = "";
    $database = "fpt";

    $conn = new mysqli($hostname, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if username already exists
    $check_username_query = "SELECT * FROM users WHERE fullname = '$username'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        die("Fullname already exists. Please choose a different fullname.");
    }

    // Prepare and bind SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (id, fullname, Address, gender) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $rollno, $username, $address, $gender);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect user after successful insertion
        header("Location: home_page.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
