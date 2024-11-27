<?php
// Connexion à la base de données
$connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);

    // Récupérer l'historique des événements de l'utilisateur
    $queryEvents = "SELECT * FROM RESERVATION INNER JOIN EVENEMENT ON RESERVATION.idEvent = EVENEMENT.idEvent WHERE idUser = :idUser";    $stmtEvents = $connection->prepare($queryEvents);
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
// Mettre à jour l'état de la commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateOrder'])) {
    $idCommande = intval($_POST['idCommande']);
    $newEtat = intval($_POST['newEtat']);

    $updateQuery = "UPDATE COMMANDE SET etatCommande = :newEtat WHERE idCommande = :idCommande";
    $stmtUpdate = $connection->prepare($updateQuery);
    $stmtUpdate->execute([':newEtat' => $newEtat, ':idCommande' => $idCommande]);

    // Rafraîchir la page pour afficher les modifications
    header("Location: historique.php?idUser=$idUser");
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
    <div class="container">
        <h1>Historique de l'utilisateur</h1>

        <h2>Événements</h2>
        <?php if (!empty($events)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titre de l'événement</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($event['titreEvent']); ?></td>
                            <td><?php echo htmlspecialchars($event['dateEvent']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>

        <h2>Commandes</h2>
        <?php if (!empty($orders)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID de la commande</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['idCommande']); ?></td>
                            <td><?php echo htmlspecialchars($order['dateCommande']); ?></td>
                            <td><?php echo $order['etatCommande'] == 0 ? 'Dans le panier' : 'Payée mais pas distribuée'; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="idCommande" value="<?php echo $order['idCommande']; ?>">
                                    <select name="newEtat">
                                        <option value="0" <?php if ($order['etatCommande'] == 0) echo 'selected'; ?>>Dans le panier</option>
                                        <option value="1" <?php if ($order['etatCommande'] == 1) echo 'selected'; ?>>Payée mais pas distribuée</option>
                                    </select>
                                    <button type="submit" name="updateOrder">Mettre à jour</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune commande trouvée.</p>
        <?php endif; ?>
    </div>
</body>
</html>