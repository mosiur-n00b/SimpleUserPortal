<?php session_start();require_once "database.php"; ?>
<?php

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Your error checking and password verification code...

    if ($row) {
        $db_pass = $row["password"];
        if (password_verify($password, $db_pass)) {
            // Set session variables for the user's data
            $_SESSION["firstName"] = $row["firstName"];
            $_SESSION["lastName"] = $row["lastName"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["phone"] = $row["phone"];
            $_SESSION["email"] = $email;
            $_SESSION["birthday"] = $row["birthdate"];

            echo "Login Successful. Redirecting to your profile...";
            header("Location: userprofile.php"); // Redirect to the user profile page
            exit();
        } else {
            array_push($errors, "Invalid email or password.");
        }
    } else {
        array_push($errors, "Invalid Email.");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            position: relative;
        }
        h1 {
            text-align: center;
            color: #333; /* Dark text color */
        }
        .profile-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            position: relative;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-header h2 {
            color: #007bff; /* Blue header color */
        }
        .user-details {
            text-align: left;
            padding: 10px;
        }
        .user-details label {
            font-weight: bold;
            color: #555; /* Dark gray label text color */
        }
        .user-details p {
            margin: 5px 0;
        }
        .user-name {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #007bff; /* Blue user name color */
        }
        .action-buttons {
            display: none;
            position: absolute;
            top: 40px; /* Adjust the distance below the user name */
            right: 10px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1; /* Ensure it appears above other content */
        }
        .action-buttons button {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            display: block;
        }
        .action-buttons button:hover {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
     <!-- User name -->
     <div class="user-name" onclick="toggleActions()">
        Welcome, <?php echo $_SESSION["firstName"]; ?>!
    </div>

    <!-- Action buttons -->
    <div class="action-buttons" id="action-buttons">
        <form action="logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        <button onclick="window.location.href='changepassword.php'">Change Password</button>
    </div>

    <h1>User Profile</h1>
    <div class="profile-container">
        <div class="user-details">
            <label>First Name:</label>
            <p><?php echo $_SESSION["firstName"]; ?></p>
        </div>
        <div class="user-details">
            <label>Last Name:</label>
            <p><?php echo $_SESSION["lastName"]; ?></p>
        </div>
        <div class="user-details">
            <label>Address:</label>
            <p><?php echo $_SESSION["address"]; ?></p>
        </div>
        <div class="user-details">
            <label>Phone:</label>
            <p><?php echo $_SESSION["phone"]; ?></p>
        </div>
        <div class="user-details">
            <label>Email:</label>
            <p><?php echo $_SESSION["email"]; ?></p>
        </div>
        <div class="user-details">
            <label>Birthdate:</label>
            <p><?php echo $_SESSION["birthday"]; ?></p>
        </div>
    </div>

    <script>
        function toggleActions() {
            var actions = document.getElementById("action-buttons");
            actions.style.display = actions.style.display === "none" ? "block" : "none";
        }
    </script>
</body>
</html>
