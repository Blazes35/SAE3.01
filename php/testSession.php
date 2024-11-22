<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['SetCookie'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $role = htmlspecialchars($_POST['role']);
        $grade = htmlspecialchars($_POST['grade']);
        $pp = htmlspecialchars($_POST['pp']);

        session_start();

        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['grade'] = $grade;
        $_SESSION['pp'] = $pp;

        echo "Session has been set.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set and Test Session</title>
</head>
<body>
    <form method="post" action="">
        <h2>Set Session</h2>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <input type="submit" value="Set Session" name="SetCookie">
    </form>
    
    <form method="post" action="">
        <h2>Test Session</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Test Session" name="TestCookie">
    </form>

    <form method="post" action="">
        <h2>Show Session</h2>
        <input type="submit" value="Show Session" name="ShowCookie">
    </form>
</body>
</html>

