<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $check_sql = "SELECT * FROM User WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        echo "Username already exists.";
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO User (username, password) VALUES ('$username', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
