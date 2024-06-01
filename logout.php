<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout</title>
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
        <h1>Admin Logout</h1>
        <p>You have been logged out.</p>
        <a href="login.php"><button>Login Again</button></a>
    </div>
</body>
</html>
