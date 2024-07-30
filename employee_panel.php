<?php
session_start();
include('config.php');

$user_id = $_SESSION['user_id'];

// Fetch user name and total leaves
$stmt = $conn->prepare("SELECT name, total_leaves, used_leaves FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name, $total_leaves, $used_leaves);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];
    $status = 'pending';

    $stmt = $conn->prepare("INSERT INTO leave_requests (user_id, leave_type, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $leave_type, $start_date, $end_date, $reason, $status);

    if ($stmt->execute()) {
        echo "<p class='success'>Leave request submitted successfully.</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM leave_requests WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 50px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 95%;
            max-width: 800px;
            text-align: center;
        }
        h2, h3 {
            margin-bottom: 20px;
            color: #333333;
        }
        .welcome-message {
            font-size: 22px;
            color: #007bff;
            margin-bottom: 10px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            color: #555555;
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="date"],
        form select,
        form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a.logout-button {
            display: inline-block;
            margin-top: 20px;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
        a.logout-button:hover {
            background-color: #0056b3;
        }
        .total-leaves {
            font-size: 18px;
            color: #333333;
            margin-bottom: 20px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 10px;
            }
            form input[type="text"],
            form input[type="email"],
            form input[type="password"],
            form input[type="date"],
            form select,
            form textarea {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Employee Panel</h2>
        <p class="welcome-message">Welcome, <?php echo htmlspecialchars($user_name); ?>!</p>
        <p class="total-leaves">Total Leaves: <?php echo ($total_leaves - $used_leaves); ?></p>
        <form method="post" action="">
            <label>Type of Leave:</label>
            <select name="leave_type" required>
                <option value="sick">Sick</option>
                <option value="casual">Casual</option>
                <option value="earned">Earned</option>
            </select>
            <label>Start Date:</label>
            <input type="date" name="start_date" required>
            <label>End Date:</label>
            <input type="date" name="end_date" required>
            <label>Reason:</label>
            <textarea name="reason" required></textarea>
            <input type="submit" value="Request Leave">
        </form>
        <h3>Your Leave Requests</h3>
        <table>
            <tr>
                <th>Type of Leave</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['leave_type']); ?></td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                <td><?php echo htmlspecialchars($row['reason']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($row['status'])); ?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
