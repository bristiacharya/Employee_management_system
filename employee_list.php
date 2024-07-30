<?php
include 'config.php'; // Include the database connection file

// Fetch data from the employees table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $joining_date = $_POST['joining_date'];
    $package_details = $_POST['package_details'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Insert data into the employees table
    $sql = "INSERT INTO users (name, email, phone, dob, joining_date, package_details, address, role)
            VALUES ('$name', '$email', '$phone', '$dob', '$joining_date', '$package_details', '$address', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Refresh the page to see the new employee in the table
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Link to Google Fonts -->
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
            margin: 20px auto;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
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
            background-color: #f2f2f2;
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
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            display: none;
            margin: 20px auto;
            width: 100%;
        }

        form h2 {
            color: #333333;
        }

        form label {
            margin: 10px 0 5px;
            color: #333333;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            width: 100px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <script>
        function toggleForm() {
            var form = document.getElementById("addEmployeeForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Employee Details</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Joining Date</th>
                    <th>Package Details</th>
                    <th>Address</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td>" . $row["dob"] . "</td>
                                <td>" . $row["joining_date"] . "</td>
                                <td>" . $row["package_details"] . "</td>
                                <td>" . $row["address"] . "</td>
                                <td>" . $row["role"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="toggleForm()">Add Employee</button>
        <form id="addEmployeeForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:none;">
            <h2>Add New Employee</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>
            <label for="joining_date">Joining Date:</label>
            <input type="date" id="joining_date" name="joining_date" required><br>
            <label for="package_details">Package Details:</label>
            <input type="text" id="package_details" name="package_details" required><br>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea><br>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="manager">Manager</option>
                <option value="employee">Employee</option>
            </select><br>
            <button type="submit">Add Employee</button>
        </form>
    </div>
</body>
</html>
