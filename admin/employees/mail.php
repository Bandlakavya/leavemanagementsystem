<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leave_db";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $from_email = $_POST['from_email'];
    $employee_password = $_POST['password'];

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data
    $sql = "INSERT INTO employeeleaverequests (employee_id, employee_name,from_email, password) VALUES (?, ?, ?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $employee_id, $employee_name, $from_email,$password);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Leave Request Form</title>
</head>
<body>
    <h2>Employee Authenication Details</h2>
    <form method="post">
        <label for="user_id">User ID:</label>
        <input type="text" name="employee_id" required><br><br>
        
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" required><br><br>
        
        <label for="employee_email">Employee Email:</label>
        <input type="email" name="from_email" required><br><br>

        <label for="employee_password">Employee Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>