<?php

include 'functions.php';
$connection = connectToDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    if ($newPassword === $confirmPassword) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $result = changePwd($connection, $username, $password, $hashedNewPassword);
        if ($result) {
            echo "Password changed successfully";
        } else {
            echo "Password change failed";
        }
    } else {
        echo "New passwords do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <form action="changePwd.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Current Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <br>
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        <br>
        <button type="submit">Change Password</button>
    </form>
</body>
</html>