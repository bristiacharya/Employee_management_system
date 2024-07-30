<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-brand {
    font-size: 1.5em;
    font-weight: bold;
}

.navbar-motivation {
    font-size: 1em;
    font-style: italic;
}

.container {
    padding: 20px;
}

.manager-table, .employee-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.manager-table th, .employee-table th, .manager-table td, .employee-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.manager-table th, .employee-table th {
    background-color: #007BFF;
    color: #fff;
}

.manager-table tr:nth-child(even), .employee-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.manager-table tr:hover, .employee-table tr:hover {
    background-color: #ddd;
}

button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    font-size: 1em;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<nav class="navbar">
        <div class="navbar-container">
            <span class="navbar-brand">Manager Details</span>
            <span class="navbar-motivation">"Management is doing things right; leadership is doing the right things." - Peter Drucker</span>
        </div>
    </nav>
    <div class="container">
        <table class="manager-table">
            <thead>
                <tr>
                    <th>Manager ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Project</th>
                    <th>Number of Employees</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $managers = [];
                for ($i = 1; $i <= 10; $i++) {
                    $managers[] = [
                        "id" => "M00$i",
                        "name" => "Manager $i",
                        "email" => "manager$i@example.com",
                        "phone" => "100-200-300$i",
                        "address" => "$i Main Street, City $i",
                        "project" => "Project $i",
                        "employees" => []
                    ];

                    for ($j = 1; $j <= 10; $j++) {
                        $managers[$i-1]["employees"][] = [
                            "id" => "E00$j",
                            "name" => "Employee $j",
                            "email" => "employee$j@example.com",
                            "phone" => "200-300-400$j",
                            "address" => "$j Side Road, City $i"
                        ];
                    }
                }

                foreach ($managers as $manager) {
                    echo '<tr>';
                    echo '<td>' . $manager["id"] . '</td>';
                    echo '<td>' . $manager["name"] . '</td>';
                    echo '<td>' . $manager["email"] . '</td>';
                    echo '<td>' . $manager["phone"] . '</td>';
                    echo '<td>' . $manager["address"] . '</td>';
                    echo '<td>' . $manager["project"] . '</td>';
                    echo '<td>' . count($manager["employees"]) . '</td>';
                    echo '<td><button onclick="toggleDetails(\'details-' . $manager["id"] . '\')">Toggle Employee Details</button></td>';
                    echo '</tr>';
                    echo '<tr id="details-' . $manager["id"] . '" style="display:none;">';
                    echo '<td colspan="8">';
                    echo '<table class="employee-table">';
                    echo '<thead><tr><th>Employee ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($manager["employees"] as $employee) {
                        echo '<tr>';
                        echo '<td>' . $employee["id"] . '</td>';
                        echo '<td>' . $employee["name"] . '</td>';
                        echo '<td>' . $employee["email"] . '</td>';
                        echo '<td>' . $employee["phone"] . '</td>';
                        echo '<td>' . $employee["address"] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function toggleDetails(id) {
            var details = document.getElementById(id);
            if (details.style.display === "none") {
                details.style.display = "table-row-group";
            } else {
                details.style.display = "none";
            }
        }
    </script>
</body>
</html>
