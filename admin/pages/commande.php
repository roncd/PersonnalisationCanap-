<?php 
require '../config.php';
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

// Paramètres de pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 10; // Nombre de commandes par page
$offset = ($page - 1) * $limit;

$statut = isset($_GET['statut']) && in_array($_GET['statut'], ['validation', 'construction', 'final'])
    ? $_GET['statut']
    : 'validation'; 

// Récupérer les commandes pour le statut et la page actuels
$stmt = $pdo->prepare("SELECT cd.id, cd.date, cd.statut, cl.id 
    AS id_client, cl.nom, cl.prenom 
    FROM commande_detail cd
    JOIN client cl 
    ON cd.id_client = cl.id 
    WHERE statut = :statut ORDER BY id DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':statut', $statut, PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre total de commandes pour ce statut
$stmtCount = $pdo->prepare("SELECT COUNT(*) AS total FROM commande_detail WHERE statut = :statut");
$stmtCount->bindValue(':statut', $statut, PDO::PARAM_STR);
$stmtCount->execute();
$totalCommandes = $stmtCount->fetchColumn();

$totalPages = ceil($totalCommandes / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title> 
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/commandes.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/popup.css">
    <script src="../../scrpit/commandes.js"></script> 
    <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
</head>
<body>
    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
        <h2>Commandes</h2>
            <div class="tableau">
            <div class="tabs">
                <button onclick="location.href='?statut=validation'" class="tab <?= ($statut === 'validation') ? 'active' : '' ?>">En attente de validation</button>
                <button onclick="location.href='?statut=construction'" class="tab <?= ($statut === 'construction') ? 'active' : '' ?>">En cours de construction</button>
                <button onclick="location.href='?statut=final'" class="tab <?= ($statut === 'final') ? 'active' : '' ?>">Commandes finalisées</button>
            </div>
                    <script>
                        function updateStatus(button) {
                        const commandDiv = button.closest('.commande'); // Récupère la commande liée
                        const commandId = commandDiv.getAttribute('data-id'); // Récupère l'ID de la commande
                        const currentStatut = commandDiv.getAttribute('data-statut'); // Récupère le statut actuel
                        console.log('Statut mis à jour pour la commande :', commandDiv);

                        // Déterminer le statut suivant
                        let nextStatut;
                        if (currentStatut === 'validation') {
                            nextStatut = 'construction';
                        } else if (currentStatut === 'construction') {
                            nextStatut = 'final';
                        } else {
                            alert('Statut final atteint.');
                            return;
                        }

                        // Envoyer une requête pour mettre à jour le statut
                        fetch('update_statut.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ id: commandId, statut: nextStatut }),
                        })
                        .then(response => {
                            console.log('Réponse brute :', response);
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                console.log('Statut mis à jour avec succès' + nextStatut);
                                location.reload();
                            } else {
                                console.error('Erreur côté serveur :', data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                        });

                        }

                        // Fonction pour masquer la commande avec confirmation
                        function removeCommand(button) {
                        const commandDiv = button.closest('.commande'); // Récupère la commande liée
                        const commandId = commandDiv.getAttribute('data-id'); // Récupère l'ID de la commande
                        const popup = document.getElementById('supprimer-popup'); // Récupère le popup
                        const yesButton = popup.querySelector('.yes-btn'); // Bouton "Oui" dans le popup
                        const noButton = popup.querySelector('.no-btn'); // Bouton "Non" dans le popup

                        // Afficher le popup
                        popup.style.display = 'flex';

                        // Ajouter un gestionnaire pour le bouton "Oui"
                        yesButton.onclick = () => {
                            console.log('Suppression confirmée de la commande.');
                               // Envoyer une requête au serveur pour supprimer la commande
                            fetch('delete_commande.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ id: commandId }), // Envoie l'ID de la commande
                            })
                            .then(response => {
                                console.log('Réponse brute :', response);
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    console.log('Commande supprimée de la base de données.');
                                    commandDiv.remove(); // Supprime la commande de l'interface
                                } else {
                                    alert('Erreur : Impossible de supprimer la commande.');
                                }
                            })
                            .catch(error => {
                                console.error('Erreur lors de la suppression :', error);
                            });

                            popup.style.display = 'none'; // Ferme le popup
                        };
                        // Ajouter un gestionnaire pour le bouton "Non"
                        noButton.onclick = () => {
                            console.log('Suppression annulée.');
                            popup.style.display = 'none'; // Ferme le popup
                        };

                        // Fermer le popup si clic à l'extérieur
                        window.addEventListener('click', (event) => {
                            if (event.target === popup) {
                                console.log('Clic à l\'extérieur du popup, fermeture.');
                                popup.style.display = 'none';
                            }
                        });
                        }

                        // Initialisation des événements après le chargement du DOM
                        document.addEventListener('DOMContentLoaded', () => {
                        console.log('DOM entièrement chargé.');
                        });
                    </script>
                            <div id="supprimer-popup" class="popup">
                            <div class="popup-content">
                                <h2>Êtes vous sûr de vouloir supprimer ?</h2> 
                                <p>(La commande disparaîtra définitivement)</p>
                                <br>
                                <button class="yes-btn">Oui</button>
                                <button class="no-btn">Non</button>
                            </div>
                            </div>
                            <div class="tab-content <?= $statut === 'validation' ? 'active' : '' ?>" id="validation">
                                <div id="commandes-container">
                                    <?php if (!empty ($commandes)): ?>
                                        <?php foreach ($commandes as $commande): ?>                  
                                            <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                                                <div class="info">
                                                    <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                                                    <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                                                    <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                                                    <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                                                </div>
                                                <div class="actions">
                                                    <i title="Passez la commande au statut suivant" class="fa-solid fa-check actions vert" onclick="updateStatus(this)"></i>
                                                    <i title="Supprimez la commande" class="fa-solid fa-trash actions rouge" onclick="removeCommand(this)"></i>
                                                    <i title="Téléchargez la commande" class="fa-solid fa-file-pdf"></i>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Aucune commande trouvée pour ce statut.</p>
                                    <?php endif; ?>
                                </div>
                                <nav class="nav" aria-label="pagination">
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                            <li><a href="?page=<?= $page - 1 ?>&statut=<?= $statut ?>">Précédent</a></li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li>
                                                <a class="<?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>&statut=<?= $statut ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $totalPages): ?>
                                            <li><a href="?page=<?= $page + 1 ?>&statut=<?= $statut ?>">Suivant</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                            <div class="tab-content <?= $statut === 'construction' ? 'active' : '' ?>" id="construction">
                                <div id="commandes-container">
                                <?php if (!empty ($commandes)): ?>
                                    <?php foreach ($commandes as $commande): ?>           
                                            <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                                                <div class="info">
                                                    <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                                                    <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                                                    <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                                                    <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                                                </div>
                                                <div class="actions">
                                                    <i title="Passez la commande au statut suivant" class="fa-solid fa-check actions vert" onclick="updateStatus(this)"></i>
                                                    <i title="Supprimez la commande" class="fa-solid fa-trash actions rouge" onclick="removeCommand(this)"></i>
                                                    <i title="Téléchargez la commande" class="fa-solid fa-file-pdf"></i>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Aucune commande trouvée pour ce statut.</p>
                                    <?php endif; ?>
                                </div>
                                <nav class="nav" aria-label="pagination">
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                            <a href="?page=<?= $page - 1 ?>&statut=<?= $statut ?>">Précédent</a>
                                        <?php endif; ?>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li>
                                                <a class="<?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>&statut=<?= $statut ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $totalPages): ?>
                                            <li><a href="?page=<?= $page + 1 ?>&statut=<?= $statut ?>">Suivant</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>

                            <div class="tab-content <?= $statut === 'final' ? 'active' : '' ?>" id="final">
                            <div id="commandes-container">
                            <?php if (!empty ($commandes)): ?>
                                <?php foreach ($commandes as $commande): ?>
                                            <div class="commande" data-id="<?= htmlspecialchars($commande['id']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>">
                                                <div class="info">
                                                    <p><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></p>
                                                    <p><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></p>
                                                    <p><strong>Date :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($commande['date']))) ?></p>
                                                    <p><strong>N° commande :</strong> <?= htmlspecialchars($commande['id']) ?></p>
                                                </div>
                                                <div class="actions">
                                                    <i title="Supprimez la commande" class="fa-solid fa-trash actions rouge" onclick="removeCommand(this)"></i>
                                                    <i title="Téléchargez la commande" class="fa-solid fa-file-pdf"></i>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Aucune commande trouvée pour ce statut.</p>
                                    <?php endif; ?>
                                </div>
                                <nav class="nav" aria-label="pagination">
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                            <li><a href="?page=<?= $page - 1 ?>&statut=<?= $statut ?>">Précédent</a></li>
                                        <?php endif; ?>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li>
                                                <a class="<?= $i === $page ? 'active' : '' ?>" href="?page=<?= $i ?>&statut=<?= $statut ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <?php if ($page < $totalPages): ?>
                                            <li><a href="?page=<?= $page + 1 ?>&statut=<?= $statut ?>">Suivant</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
        </div>
    </main>
    <footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</body>
</html>