<?php
session_start();
include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_id']) && isset($_POST['action'])) {
    $leave_id = $_POST['leave_id'];
    $action = $_POST['action'];
    $response_message = $_POST['response_message'];

    // Get user ID associated with the leave request
    $stmt = $conn->prepare("SELECT user_id FROM leave_requests WHERE id=?");
    $stmt->bind_param("i", $leave_id);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($action == 'approve') {
        // Approve the leave and update used leaves
        $stmt = $conn->prepare("UPDATE leave_requests SET status='approved', response_message=? WHERE id=?");
        $stmt->bind_param("si", $response_message, $leave_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("UPDATE users SET used_leaves = used_leaves + 1 WHERE id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    } else if ($action == 'reject') {
        // Reject the leave
        $stmt = $conn->prepare("UPDATE leave_requests SET status='rejected', response_message=? WHERE id=?");
        $stmt->bind_param("si", $response_message, $leave_id);
        $stmt->execute();
        $stmt->close();
    }
}

$sql = "SELECT lr.id, lr.leave_type, lr.start_date, lr.end_date, lr.reason, lr.status, u.name, u.total_leaves, u.used_leaves 
        FROM leave_requests lr 
        JOIN users u ON lr.user_id = u.id";
$result = $conn->query($sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
        <h2>Admin Panel</h2>
        <h3>Leave Requests</h3>
        <table>
            <tr>
                <th>Employee Name</th>
                <th>Type of Leave</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Total Leaves</th>
                <th>Used Leaves</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['leave_type']); ?></td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                <td><?php echo htmlspecialchars($row['reason']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($row['status'])); ?></td>
                <td><?php echo htmlspecialchars($row['total_leaves']); ?></td>
                <td><?php echo htmlspecialchars($row['used_leaves']); ?></td>
                <td>
                    <?php if ($row['status'] == 'pending') { ?>
                    <form method="post" action="">
                        <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                        <label>Response Message:</label>
                        <textarea name="response_message" required></textarea>
                        <input type="submit" name="action" value="approve">
                        <input type="submit" name="action" value="reject">
                    </form>
                    <?php } else { ?>
                    <p><?php echo ucfirst(htmlspecialchars($row['status'])); ?></p>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>


