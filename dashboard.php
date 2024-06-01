<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #4a148c, #6a1b9a);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .header {
            background-color: #8e24aa;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .card {
            background-color: #4a148c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 300px;
            margin: 10px;
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
        canvas {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="container">
        <div class="card">
            <h2>Execute Database Command</h2>
            <form method="post" action="dashboard.php">
                <input type="text" name="db_command" placeholder="Enter SQL command" required>
                <button type="submit">Execute</button>
            </form>
            <?php
            require 'functions.php';
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['db_command'])) {
                $db_command = $_POST['db_command'];
                $conn = db_connect();
                if ($conn->query($db_command) === TRUE) {
                    echo "<p>Command executed successfully.</p>";
                } else {
                    echo "<p>Error: " . $conn->error . "</p>";
                }
                $conn->close();
            }
            ?>
        </div>
        <div class="card">
            <h2>Execute Server Command</h2>
            <form method="post" action="dashboard.php">
                <input type="text" name="server_command" placeholder="Enter server command" required>
                <button type="submit">Execute</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['server_command'])) {
                $server_command = $_POST['server_command'];
                $output = shell_exec($server_command);
                echo "<pre>$output</pre>";
            }
            ?>
        </div>
        <div class="card">
            <h2>Admin Actions</h2>
            <button onclick="showGraph()">Show Graph</button>
            <button onclick="hideGraph()">Hide Graph</button>
        </div>
    </div>
    <canvas id="myChart" class="hidden"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showGraph() {
            document.getElementById('myChart').classList.remove('hidden');
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function hideGraph() {
            document.getElementById('myChart').classList.add('hidden');
        }
    </script>
</body>
</html>
