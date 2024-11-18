<?php
include 'functions.php';

$connection = connectToDatabase();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = createUser($connection, $_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['profilePicture'], $_POST['password'], $_POST['roleId']);
        echo $result;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <form method="post" action="">
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="profilePicture">Profile Picture:</label>
        <input type="text" id="profilePicture" name="profilePicture" value="default_pp.jpg" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="roleId">TP:</label>
        <input type="text" id="roleId" name="roleId" required><br>

        <button type="submit">Create User</button>
    </form>
</body>
</html>
