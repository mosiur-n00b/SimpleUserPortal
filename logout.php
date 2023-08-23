<?php
// Start or resume the user's session
session_start();

// Check if the "logout" button has been clicked
if (isset($_POST['logout'])) {
    // Unset and destroy the user's session
    session_unset();
    session_destroy();
}

// Redirect the user to the login page or any other desired location
header("Location: login.php"); // Change "login.php" to the actual login page URL
exit();
?>
