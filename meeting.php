<?php
include 'config.php'; // Include your database connection file

// Flag to indicate if a new meeting was added successfully
$meetingAdded = false;

// Add a new meeting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addMeeting'])) {
    $meetingDate = $_POST['meeting_date'];
    $meetingTime = $_POST['meeting_time'];
    $meetingDateTime = $meetingDate . ' ' . $meetingTime;

    $sql = "INSERT INTO meetings (meeting_date) VALUES ('$meetingDateTime')";
    if ($conn->query($sql) === TRUE) {
        $meetingAdded = true;
    } else {
        echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Fetch meetings from the database
$sql = "SELECT * FROM meetings ORDER BY meeting_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #dddddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        form h2 {
            color: #333333;
        }

        form label {
            margin: 10px 0 5px;
            color: #333333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            width: 120px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        form button:hover {
            background-color: #45a049;
        }

        .form-container {
            display: none;
            transition: max-height 0.2s ease-out;
        }

        .form-container.show {
            display: block;
        }

        .toggle-button, .close-button {
            text-align: center;
            margin: 20px auto;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #333;
        }

        .close-button:hover {
            color: #ff0000;
        }
    </style>
    <script>
        function toggleForm() {
            var form = document.getElementById('meetingForm');
            form.classList.toggle('show');
        }

        window.onload = function() {
            <?php if ($meetingAdded): ?>
                alert('Meeting added successfully!');
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Meeting Details</h1>
        
        <!-- Button to toggle the form -->
        <div class="toggle-button">
            <button onclick="toggleForm()">Add Meeting</button>
        </div>

        <!-- Form to add a new meeting -->
        <div id="meetingForm" class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <button type="button" class="close-button" onclick="toggleForm()">&times;</button>
                <h2>Add New Meeting</h2>
                <label for="meeting_date">Meeting Date:</label>
                <input type="date" id="meeting_date" name="meeting_date" required>
                <label for="meeting_time">Meeting Time:</label>
                <input type="time" id="meeting_time" name="meeting_time" required>
                <button type="submit" name="addMeeting">Add Meeting</button>
            </form>
        </div>

        <!-- Table to display meeting details -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meeting Date and Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["meeting_date"] . "</td>
                                <td>" . $row["created_at"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No meetings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
