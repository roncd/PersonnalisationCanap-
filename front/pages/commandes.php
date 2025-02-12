<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: ../formulaire/Connexion.php"); // Redirection vers la page de connexion
    exit();
}

$userId = $_SESSION['user_id'];

// Récupérer les commandes de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT * FROM commande_detail WHERE id_client = ?");
$stmt->execute([$userId]);
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$statuts = [
    'validation' => [],
    'construction' => [],
    'final' => []
];

// Organiser les commandes par statut
foreach ($commandes as $commande) {
    $statuts[$commande['statut']][] = $commande;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/commandes.css">    
</head>
<body>

    <header>
    <?php require '../../squelette/header.php'; ?>
    </header>

    <main>
        <div class="container">
            <!-- Colonne de gauche -->
            <h2>Mes commandes</h2>
            <div class="tableau">
                <div class="tabs">
                    <button class="tab active" data-tab="validation">En attente de validation</button>
                    <button class="tab" data-tab="construction">En cours de construction</button>
                    <button class="tab" data-tab="final">Commandes finalisées</button>
                </div>

                <div class="tab-content active" id="validation">
                    <?php foreach ($statuts['validation'] as $commande): ?>
                    <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                        <div class="info">
                            <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                            <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                            <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                            <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                        </div>
                        <div class="actions">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="tab-content" id="construction">
                    <?php foreach ($statuts['construction'] as $commande): ?>
                    <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                        <div class="info">
                            <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                            <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                            <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                            <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                        </div>
                        <div class="actions">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="tab-content" id="final">
                    <?php foreach ($statuts['final'] as $commande): ?>
                    <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                        <div class="info">
                            <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                            <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                            <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                            <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                            </div>
                        <div class="actions">
                        <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>         
        </div>
        
</main>
<script src="../../scrpit/commandes.js"></script> 
<?php require_once '../../squelette/footer.php'?>
</body>
</html>

