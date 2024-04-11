<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Káº¿t ná»‘i Ä‘áº¿n cÆ¡ sá»Ÿ dá»¯ liá»‡u
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "fpt";

    $conn = new mysqli($hostname, $username, $password, $database);

    // Kiá»ƒm tra káº¿t ná»‘i
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Thá»±c hiá»‡n cÃ¢u lá»‡nh SQL Ä‘á»ƒ xÃ³a sinh viÃªn khá»i cÆ¡ sá»Ÿ dá»¯ liá»‡u
    $sql = "DELETE FROM users WHERE id=$student_id";

    if ($conn->query($sql) === TRUE) {
        // Chuyá»ƒn hÆ°á»›ng ngÆ°á»i dÃ¹ng sau khi xÃ³a sinh viÃªn thÃ nh cÃ´ng
        header("Location: home_page.php");
        exit();                 
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
