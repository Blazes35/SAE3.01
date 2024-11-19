<?php
function connectToDatabase() {
    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}




function changePwd($connection, $username, $password, $newPassword) {
    $sql = "call changePwd(\"$username\", \"$password\", \"$newPassword\")";
    $init = $connection -> prepare($sql);
    $init -> execute();
    $result = $init->fetch()[0];
    return $result;
}

function createUser($connection, $lastName, $firstName, $email, $profilePicture, $password, $idTpAgenda) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "CALL createUser(\"$lastName\", \"$firstName\", \"$email\", \"$profilePicture\", \"$hashedPassword\", \"$idTpAgenda\")";
    $init = $connection->prepare($sql);
    $init->execute();
    $result= $init->fetch()[0];
    if ($result == 1) {
        return "Utilisateur créee avec succès";
    } else {
        return $result;
    }
}
?>