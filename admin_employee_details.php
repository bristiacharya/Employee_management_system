<?php
include 'config.php'; 


$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   
    $sql = "UPDATE users SET password='$password' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <link rel="stylesheet" href="styles.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
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
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    background: #ffffff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 12px;
    overflow: hidden;
}

h1 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px;
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
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

button {
    display: block;
    width: 150px;
    margin: 10px auto;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
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
}

form h2 {
    color: #333333;
    margin-bottom: 10px;
}

form label {
    margin: 10px 0 5px;
    color: #333333;
    font-size: 16px;
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

.hidden {
    display: none;
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

    </style>
    <script>
        function toggleForm(id) {
            var form = document.getElementById("passwordForm-" + id);
            var setButton = document.getElementById("setPasswordButton-" + id);
            var changeButton = document.getElementById("changePasswordButton-" + id);

            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
                setButton.classList.add("hidden");
            } else {
                form.classList.add("hidden");
                changeButton.classList.remove("hidden");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Employee Panel</h1>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                        
                        $passwordSet = !empty($row["password"]);
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
                                <td class='form-container'>
                                    " . (!$passwordSet ? 
                                    "<button id='setPasswordButton-" . $row["id"] . "' onclick='toggleForm(" . $row["id"] . ")'>Set Password</button>" :
                                    "<button id='changePasswordButton-" . $row["id"] . "' onclick='toggleForm(" . $row["id"] . ")'>Change Password</button>") . "
                                    <form id='passwordForm-" . $row["id"] . "' method='post' action='" . $_SERVER['PHP_SELF'] . "' class='" . ($passwordSet ? "hidden" : "") . "'>
                                        <h2>" . (!$passwordSet ? "Set Password" : "Change Password") . "</h2>
                                        <label for='password'>Password:</label>
                                        <input type='password' id='password' name='password' required>
                                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                                        <button type='submit'>Save</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
