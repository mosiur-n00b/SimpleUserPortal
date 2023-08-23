<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
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

        .login-panel {
            background-color: #ffffff;
            padding: 20px;
            height: 400px;
            width: 400px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-panel h2 {
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

        .login-button,
        .clear-button {
            flex: 1; /* Equal width for both buttons */
            margin-right: 10px; /* Add some spacing between buttons */
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .clear-button {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .clear-button:hover {
            background-color: #d32f2f;
        }

        .login-button {
            background-color: #4caf50;
            color: white;
            border: none;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .register-button {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>
    <div class="login-panel">
        <h2>Login Panel</h2>
        <?php
            //print_r($_POST);
            require_once "database.php";
            session_start();
            if(isset($_POST["submit"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
            
                $errors = array();
            
                if(empty($email) || empty($password)) {
                    array_push($errors, "All fields are required.");
                }
            
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid.");
                }
            
                if(count($errors) == 0) {
                    // Use prepared statements to query the database securely
                    $email_search = "SELECT email, password FROM register WHERE email = ?";
                    $stmt = mysqli_stmt_init($conn);
            
                    if(mysqli_stmt_prepare($stmt, $email_search)) {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
            
                        if($row) {
                            $db_pass = $row["password"];
                            if(password_verify($password, $db_pass)) {
                                // Fetch additional user information from the database
                                $user_query = "SELECT firstName, lastName, address, phone, birthdate FROM register WHERE email = ?";
                                $stmt = mysqli_stmt_init($conn);
            
                                if (mysqli_stmt_prepare($stmt, $user_query)) {
                                    mysqli_stmt_bind_param($stmt, "s", $email);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    
                                    if (!$result) {
                                        die("Query error: " . mysqli_error($conn)); // Check for query errors
                                    }
                                    
                                    if (mysqli_num_rows($result) > 0) {
                                        $user_data = mysqli_fetch_assoc($result);
                                        // Debugging: Check if user_data is populated correctly
                                        // print_r($user_data);
                                        
                                        if ($user_data) {
                                            // Save user information in session variables
                                            $_SESSION["email"] = $email;
                                            $_SESSION["firstName"] = $user_data["firstName"];
                                            $_SESSION["lastName"] = $user_data["lastName"];
                                            $_SESSION["address"] = $user_data["address"];
                                            $_SESSION["phone"] = $user_data["phone"];
                                            $_SESSION["birthday"] = $user_data["birthdate"];
                                
                                            // echo "Login Successful.";
                                            header("Location: userprofile.php");
                                            exit;
                                        } else {
                                            array_push($errors, "Failed to fetch user data.");
                                        }
                                    } else {
                                        array_push($errors, "No user data found for this email.");
                                    }
                                } else {
                                    die("User query prepare failed: " . mysqli_error($conn));
                                }
                                
                            } else {
                                array_push($errors, "Invalid email or password.");
                            }
                        } else {
                            array_push($errors, "Invalid Email.");
                        }
                    } else {
                        die("Something went wrong.");
                    }
                }
            
                // Display errors
                if(count($errors) > 0) {
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    echo "<div class='alert alert-success'>You've logged in successfully.</div>";
                }
            }
            
            
        ?>
        <form action="login.php" method="post">
        <div class="input-container">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="input-container">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="form-buttons">
            <input type="submit" class="login-button" value="Login" name="submit">
            <button class="clear-button" onclick="clearForm()">Clear</button>
        </div>
        </form>
        <p>Are you new here? <button class="register-button" onclick="registerNow()"><a href="registration.php">Register Now</a></button></p>
    </div>

    <script>
        function clearForm() {
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";
        }

        function registerNow() {
            // Redirect or perform registration logic
            alert("Register Now button clicked!");
        }
    </script>
</body>
</html> 