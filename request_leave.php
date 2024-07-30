<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $leave_type = $_POST['leave_type'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $conn->real_escape_string($_POST['reason']);

        $sql = "INSERT INTO leave_requests (user_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $leave_type, $start_date, $end_date, $reason);

        if ($stmt->execute()) {
            // Decrease total leaves
            $sql = "UPDATE employees SET total_leaves = total_leaves - 1 WHERE user_id='$user_id'";
            $conn->query($sql);
            
            echo "<script>alert('Leave request submitted successfully!'); window.location.href='employee_panel.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error: User not logged in.";
    }
}
$conn->close();
?>
