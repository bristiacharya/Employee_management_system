<?php
include 'connection.php'; // Include the database connection file

// Fetch data from the attendance table
$sql = "SELECT id, text, created_at FROM attendance";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<style>
    /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 90%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 2em;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f7f7f7;
    color: #333;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

tbody td {
    transition: background-color 0.3s;
}

tbody tr:hover td {
    background-color: #f1f1f1;
}

thead th {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
}

/* Responsive Design */
@media (max-width: 768px) {
    th, td {
        padding: 10px;
    }

    h1 {
        font-size: 1.5em;
    }
}

@media (max-width: 480px) {
    th, td {
        padding: 8px;
    }

    h1 {
        font-size: 1.2em;
    }
}


</style>
<body>
    <div class="container">
        <h1>Attendance Records</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>IN Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["text"] . "</td>
                                <td>" . $row["created_at"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found</td></tr>";
                }
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
