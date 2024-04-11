<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Student</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: crimson
    }

    label {
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: aqua;
        color: dimgray;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: antiquewhite;
    }
</style>
</head>
<body>
    <h2>EDIT STUDENT</h2>
    <!-- Edit Student Form -->
    <form method="post" action="edit_page.php">
        <label for="rollno">Roll No:</label>
        <input type="text" id="id" name="id">
        <label for="name">Name:</label>
        <input type="text" id="fullname" name="fullname">
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address">
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender">
        <button class="btn edit-student">Edit Student</button>
    </form>


    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data for updating student information
    $student_id = $_POST['id'];
    $username = $_POST['fullname'];
    $address = $_POST['Address'];
    $gender = $_POST['gender'];

    // Káº¿t ná»‘i Ä‘áº¿n cÆ¡ sá»Ÿ dá»¯ liá»‡u
    $hostname = "localhost";
    $db_username = "root"; // Renamed to avoid variable overwriting
    $db_password = "";
    $database = "fpt";

    $conn = new mysqli($hostname, $db_username, $db_password, $database);

    // Kiá»ƒm tra káº¿t ná»‘i
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the new username is already in use by another student
    $check_username_query = "SELECT id FROM users WHERE fullname = ? AND id != ?";
    $stmt = $conn->prepare($check_username_query);
    $stmt->bind_param("si", $username, $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Fullname '$username' is already in use. Please choose a different fullname.";
        exit();
    }
    $update_query = "UPDATE users SET fullname=?, Address=?, gender=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi", $username, $address, $gender, $student_id);

    if ($stmt->execute()) {
        // Redirect user after successful update
        header("Location: home_page.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
