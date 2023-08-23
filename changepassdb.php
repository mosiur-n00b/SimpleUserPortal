<?php
session_start();
require_once "database.php";

if (isset($_POST["changePassword"])) {
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    
    // Check if the current password matches the one stored in the database
    $email = $_SESSION["email"]; // Assuming you have an "email" session variable
    
    // Fetch the user's data from the database
    $sql = "SELECT password FROM register WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $dbPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    // Verify the current password
    if (password_verify($currentPassword, $dbPassword)) {
        // Check if the new password matches the confirmation
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update the user's password in the database
            $updateSql = "UPDATE register SET password = ? WHERE email = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($updateStmt, "ss", $hashedNewPassword, $email);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);
            
            echo "Password changed successfully.";
        } else {
            echo "New password and confirmation do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>
