<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentList</title>
<style>
        /* Table Styles */
       /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

/* Heading Style */
h2 {
    color: black;
    background-color: plum;
    padding: 20px;
    margin-bottom: 20px;
}

/* Form Styles */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f9fa;
    color: #333;
    text-align: left;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e2e2e2;
}

/* Link Styles */
a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
}

    </style>
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style> -->
</head>

<body>
    <?php

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "fpt";

        // Create a connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Execute the SELECT query
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch all rows as an associative array
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
    <h2>Students List</h2>
    <!-- Add Student Form -->
    <form method="post" action="add_page.php">
        <label for="rollno">Roll No:</label>
        <input type="text" id="id" name="id"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="fullname" name="fullname"><br><br>
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address"><br><br>
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender"><br><br>
        <!-- <input type="submit" value="Add Student"> -->
        <button type="submit" name= 'btn_add' class="btn add-student" >Add Student</button>
    </form>

    <!-- Students Table -->
    <table>
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
<td>
    <?php echo $row['Address']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td>
                    <a href="edit_page.php?id=<?php echo $row['id']; ?>">Edit</a> 
                    <a href="delete_page.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            
        <?php } ?>
    </table>

    

</body>

</html>
