<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .registration-panel {
            background-color: #ffffff;
            padding: 20px;
            max-width: 600px;
            width: 100%;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .registration-panel h2 {
            margin-bottom: 20px;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .input-container label {
            font-weight: bold;
        }

        .input-container input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between; /* Place buttons side by side */
            align-items: center;
        }

        .register-button,
        .cancel-button {
            flex: 1; /* Equal width for both buttons */
            margin-right: 10px; /* Add some spacing between buttons */
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            border: none;
        }

        .register-button {
            background-color: #4caf50;
            color: white;
        }

        .register-button:hover {
            background-color: #45a049;
        }

        .cancel-button {
            background-color: #f44336;
            color: white;
        }

        .cancel-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="registration-panel">
        <h2>Registration Panel</h2>
        <?php
            //print_r($_POST);
            if(isset($_POST["submit"])) {
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $birthdate = $_POST["birthdate"];
                $password = $_POST["password"];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();
                if(empty($firstName) OR empty($lastName) OR empty($address) OR empty($phone) OR empty($email) OR empty($birthdate) OR empty($password)) {
                    array_push($errors, "All fields are required.");
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid.");
                }
                if(strlen($password)<8) {
                    array_push($errors, "Passwords must have at least 8 characters.");
                }
                require_once "database.php";
                $sql = "SELECT * FROM register WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if($rowCount>0) {
                    array_push($errors, "Email already exists. Try again!"); //Email address should be unique across the system. 
                }
                if(count($errors)>0) {
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error<>";
                    }
                } else {
                    $sql = "INSERT INTO register (firstName, lastName, address, phone, email, birthdate, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $address, $phone, $email, $birthdate, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    } else {
                        die("Something went wrong!");
                    }
                }
            }
        ?>
        <form action="registration.php" method="post">
        <div class="input-container">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="Enter your first name">
        </div>
        <div class="input-container">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Enter your last name">
        </div>
        <div class="input-container">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address">
        </div>
        <div class="input-container">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number">
        </div>
        <div class="input-container">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="input-container">
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate">
        </div>
        <div class="input-container">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="form-buttons">
            <input type="submit" class="register-button" value="Register" name="submit">
            <button class="cancel-button" onclick="cancel()"><a href="login.php">Cancel</a></button>
        </div>
        </form>
    </div>
    <script>
        function register() {
            alert("Register button clicked!");
        }

        function cancel() {
            alert("Cancel button clicked!");
        }
    </script>
</body>
</html>
