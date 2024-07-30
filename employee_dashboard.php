<?php
session_start();
include('config.php');

// Check if the user is logged in and has the employee role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .box {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 200px;
        }
        .box h2 {
            margin-top: 0;
        }
        .box button, .box a {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .box button:hover, .box a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h2>Attendance</h2>
            <button onclick="window.location.href='index.html'">Mark Attendance</button>
        </div>
        <div class="box">
            <h2>Apply for Leave</h2>
            <a href="employee_panel.php" id="applyLeave">Apply Now</a>
        </div>
        <div class="box">
            <h2>Project Details</h2>
            <button onclick="window.location.href='individual_project_details.php'">View Project Details</button>
        </div>
    </div>
</body>
</html>

