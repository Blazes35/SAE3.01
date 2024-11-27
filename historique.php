<?php
// Connexion à la base de données
$connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);

    // Récupérer l'historique des événements de l'utilisateur
    $queryEvents = "SELECT * FROM RESERVATION WHERE idUser = :idUser";
    $stmtEvents = $connection->prepare($queryEvents);
    $stmtEvents->execute([':idUser' => $idUser]);
    $events = $stmtEvents->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer l'historique des commandes de l'utilisateur
    $queryOrders = "SELECT * FROM COMMANDE WHERE idUser = :idUser";
    $stmtOrders = $connection->prepare($queryOrders);
    $stmtOrders->execute([':idUser' => $idUser]);
    $orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "ID utilisateur non fourni.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique de l'utilisateur</title>
    <link rel="stylesheet" href="historique.css">
</head>
<body>
    <h1>Historique de l'utilisateur</h1>

    <h2>Événements</h2>
    <?php if (!empty($events)): ?>
        <ul>
            <?php foreach ($events as $event): ?>
                <li><?php echo htmlspecialchars($event['titreEvent']); ?> - <?php echo htmlspecialchars($event['dateEvent']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun événement trouvé.</p>
    <?php endif; ?>

    <h2>Commandes</h2>
    <?php if (!empty($orders)): ?>
        <ul>
            <?php foreach ($orders as $order): ?>
                <li>Commande #<?php echo htmlspecialchars($order['idCommande']); ?> - <?php echo htmlspecialchars($order['dateCommande']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune commande trouvée.</p>
    <?php endif; ?>
</body>
</html>