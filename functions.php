<?php
function db_connect() {
    $db_host = 'localhost';
    $db_username = 'root'; // Change this to your database username
    $db_password = ''; // Change this to your database password
    $db_name = 'admin_panel'; // Change this to your database name

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function authenticate_user($username, $password) {
    $conn = db_connect();

    $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}
?>
