<?php 
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $prix = trim($_POST['prix']);
    $commentaire = trim($_POST['commentaire']);
    $date = trim($_POST['date']);
    $statut = trim($_POST['statut']);
    $idClient = trim($_POST['client']);
    $idStructure = trim($_POST['structure']); 
    $idDimension = trim($_POST['dimension']);
    $idBanquette = trim($_POST['banquette']);
    $idMousse = trim($_POST['mousse']);
    $idCouleurBois = trim($_POST['couleurbois']);
    $idDecoration = trim($_POST['decoration']);
    $idAccoudoirBois = trim($_POST['accoudoirbois']);
    $idDossierBois = trim($_POST['dossierbois']);
    $idTissuBois = trim($_POST['couleurtissubois']);
    $idMotifBois = trim($_POST['motifbois']);
    $idModele = trim($_POST['modele']);
    $idCouleurTissu = trim($_POST['couleurtissu']);
    $idMotifTissu = trim($_POST['motiftissu']);
    $idAccoudoirTissu = trim($_POST['accoudoirtissu']);
    $idDossierTissu = trim($_POST['dossiertissu']);


    // Validation des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($prix) || empty($idClient) || empty($idStructure) || empty($idDimension) || empty($idBanquette) || empty($idMousse)) {
        $_SESSION['message'] = 'Tous les champs sont requis !';
        $_SESSION['message_type'] = 'error';
    }

    // Tentative d'insertion dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO commande_detail (nom, prenom, prix, commentaire, date, statut, id_client, id_structure, id_dimension, id_banquette, id_mousse, id_couleur_bois, id_decoration, id_accoudoir_bois, id_dossier_bois, id_couleur_tissu_bois, id_motif_bois, id_modele, id_couleur_tissu, id_motif_tissu, id_accoudoir_tissu, id_dossier_tissu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $prix, $commentaire, $date, $statut, $idClient, $idStructure, $idDimension, $idBanquette, $idMousse, $idCouleurBois, $idDecoration, $idAccoudoirBois, $idDossierBois, $idTissuBois, $idMotifBois, $idModele, $idCouleurTissu, $idMotifTissu, $idAccoudoirTissu, $idDossierTissu]);

        $_SESSION['message'] = 'La commande a été ajouté avec succès !';
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erreur lors de l\'ajout de la commande : ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajoute une commande détaillée</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
    <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
    <style>
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
            <h2>Ajoute une commande détaillée</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message ' . htmlspecialchars($_SESSION['message_type']) . '">';
                echo htmlspecialchars($_SESSION['message']);
                echo '</div>';
                // Unset the message after displaying it
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <div class="form">
                <form class="formulaire-creation-compte" action="" method="POST" enctype="multipart/form-data" >
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="name" id="nom" name="nom" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="name" id="prenom" name="prenom" class="input-field" required>
                    </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group">
                        <label for="prix">Prix total (en €)</label>
                        <input type="number" id="prix" name="prix" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="text">Commentaire</label>
                        <textarea id="text" name="commentaire" class="input-field"></textarea>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date de création</label>
                        <input type="datetime-local" id="date" name="date" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="statut">Statut de la commande</label>
                        <select class="input-field" id="statut" name="statut">
                            <option value="validation">En attente de validation</option>
                            <option value="construction">En construction</option>
                            <option value="final">Finalisées</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="client">ID Client</label>
                    <input type="number" id="client" name="client" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="structure">ID Structure</label>
                    <input type="number" id="structure"  name="structure" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dimension">ID Dimension</label>
                    <input type="number" id="dimension" name="dimension" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="banquette">ID Type banquette</label>
                    <input type="number" id="banquette" name="banquette" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="mousse">ID Mousse</label>
                    <input type="number" id="mousse" name="mousse" class="input-field" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurbois">ID Couleur bois</label>
                    <input type="number" id="couleurbois" name="couleurbois" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="decoration">ID Décoration bois</label>
                    <input type="number" id="decoration" name="decoration" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirbois">ID Accoudoir bois</label>
                    <input type="number" id="accoudoirbois" name="accoudoirbois" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossierbois">ID Dossier bois</label>
                    <input type="number" id="dossierbois" name="dossierbois"  class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurtissubois">ID Couleur tissu bois</label>
                    <input type="number" id="couleurtissubois" name="couleurtissubois" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motifbois">ID Motif bois</label>
                    <input type="number" id="motifbois" name="motifbois" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="modele">ID Modèle banquette tissu</label>
                    <input type="number" id="modele" name="modele" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurtissu">ID Couleur tissu</label>
                    <input type="number" id="couleurtissu" name="couleurtissu" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motiftissu">ID Motif tissu</label>
                    <input type="number" id="motiftissu" name="motiftissu" class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossiertissu">ID Dossier tissu</label>
                    <input type="number" id="dossiertissu" name="dossiertissu"  class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirtissu">ID Accoudoir tissu</label>
                    <input type="number" id="accoudoirtissu" name="accoudoirtissu" class="input-field" >
                    </div>
                    </div>
                    <div class="footer">
                        <div class="buttons">
                        <button type="button" class="btn-retour" onclick="history.go(-1)">Retour</button>
                        <input type="submit" class="btn-valider" value="Ajouter"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</html>