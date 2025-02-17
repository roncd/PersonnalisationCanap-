<?php 
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }

$search = $_GET['search'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande détaillée</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/tab.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
    <style>
        /* Styles pour la barre de recherche et les messages */
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: rgba(227, 209, 200, 0.8);
            padding: 10px;
            border-radius: 5px;
        }
        .search-bar input {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 300px;
        }
        .search-bar button {
            padding: 8px 12px;
            font-size: 16px;
            color: white;
            background-color: #000;
            border: none;
            border-radius: 10px;
            margin-left: 8px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #333;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Commande détaillée</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message ' . htmlspecialchars($_SESSION['message_type']) . '">';
                echo htmlspecialchars($_SESSION['message']);
                echo '</div>';
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <div class="search-bar">
                <form method="GET" action="index.php">
                    <input type="text" name="search" placeholder="Rechercher par nom..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Rechercher</button>
                </form>
            </div>
            <div class="tab-container">
            <table class="styled-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>PRÉNOM</th>
                    <th>TOTAL</th>
                    <th>COMMENTAIRE</th>
                    <th>DATE</th>
                    <th>STATUT</th>
                    <th>CLIENT_ID</th>
                    <th>STRUCTUR_ID</th>
                    <th>DIMENSION_ID</th>
                    <th>TYPE_BANQUETTE_ID</th>
                    <th>MOUSSE_ID</th>  
                    <th>COULEUR_BOIS_ID</th>
                    <th>DECORATION_BOIS_ID</th>
                    <th>ACCOUDOIR_BOIS_ID</th>
                    <th>DOSSIER_BOIS_ID</th>
                    <th>COULEUR_TISSU_BOIS_ID</th>
                    <th>MOTIF_BOIS_ID</th>
                    <th>MODELE_ID</th>
                    <th>COULEUR_TISSU_ID</th>
                    <th>MOTIF_TISSU_ID</th>
                    <th>DOSSIER_TISSU_ID</th>
                    <th>ACCOUDOIR_TISSU_ID</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if ($search) {
                        $stmt = $pdo->prepare("SELECT * FROM commande_detail WHERE nom LIKE ?");
                        $stmt->execute(['%' . $search . '%']);
                    } else {
                        $stmt = $pdo->query("SELECT * FROM commande_detail");
                    } 
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['nom']}</td>";
                        echo "<td>{$row['prenom']}</td>";
                        echo "<td>{$row['prix']}</td>";
                        echo "<td>{$row['commentaire']}</td>";
                        echo "<td>{$row['date']}</td>";
                        echo "<td>{$row['statut']}</td>";
                        echo "<td>{$row['id_client']}</td>";
                        echo "<td>{$row['id_structure']}</td>";
                        echo "<td>{$row['id_dimension']}</td>";
                        echo "<td>{$row['id_banquette']}</td>";
                        echo "<td>{$row['id_mousse']}</td>";
                        echo "<td>{$row['id_couleur_bois']}</td>";
                        echo "<td>{$row['id_decoration']}</td>";
                        echo "<td>{$row['id_accoudoir_bois']}</td>";
                        echo "<td>{$row['id_dossier_bois']}</td>";
                        echo "<td>{$row['id_couleur_tissu_bois']}</td>";
                        echo "<td>{$row['id_motif_bois']}</td>";
                        echo "<td>{$row['id_modele']}</td>";
                        echo "<td>{$row['id_couleur_tissu']}</td>";
                        echo "<td>{$row['id_motif_tissu']}</td>";
                        echo "<td>{$row['id_dossier_tissu']}</td>";
                        echo "<td>{$row['id_accoudoir_tissu']}</td>";
                        echo "<td class='actions'>";
                        echo "<a href='edit.php?id={$row['id']}' class='edit-action actions vert' title='Modifier'><i class='fas fa-edit'></i></a>";
                        echo "<a href='delete.php?id={$row['id']}' class='delete-action actions rouge' title='Supprimer' onclick='return confirm(\"Voulez-vous vraiment supprimer cette commande détaillé ?\");'><i class='fas fa-trash-alt'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>
    <footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</body>
</html>