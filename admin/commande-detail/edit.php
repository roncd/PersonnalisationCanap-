<?php
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = 'ID de la commande manquant.';
    $_SESSION['message_type'] = 'error';
    header("Location: index.php");
    exit();
}

// Récupérer les données actuelles de la commande
$stmt = $pdo->prepare("SELECT * FROM commande_detail WHERE id = ?");
$stmt->execute([$id]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    $_SESSION['message'] = 'Commande introuvable.';
    $_SESSION['message_type'] = 'error';
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données
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

    if (empty($nom) || empty($prenom) || empty($prix) || empty($idClient) || empty($idStructure) || empty($idDimension) || empty($idBanquette) || empty($idMousse)) {
        $_SESSION['message'] = 'Tous les champs requis doivent être remplis.';
        $_SESSION['message_type'] = 'error';
    } else {
        // Mettre à jour la commande dans la base de données
        $stmt = $pdo->prepare("UPDATE commande_detail SET nom = ?, prenom = ?, prix = ?, commentaire = ?, date = ?, statut = ?, id_client = ?, id_structure = ?, id_dimension = ?, id_banquette = ?, id_mousse = ?, id_couleur_bois = ?, id_decoration = ?, id_accoudoir_bois = ?, id_dossier_bois = ?, id_couleur_tissu_bois = ?,  id_motif_bois = ?, id_modele = ?, id_couleur_tissu = ?, id_motif_tissu = ?, id_accoudoir_tissu = ?, id_dossier_tissu = ? WHERE id = ?");
        if ($stmt->execute([$nom, $prenom, $prix, $commentaire, $date, $statut, $idClient, $idStructure, $idDimension, $idBanquette, 
            $idMousse, $idCouleurBois, $idDecoration, $idAccoudoirBois, $idDossierBois, $idTissuBois, $idMotifBois, 
            $idModele, $idCouleurTissu, $idMotifTissu, $idAccoudoirTissu, $idDossierTissu, $id])){
            $_SESSION['message'] = 'La commande a été mise à jour avec succès !';
            $_SESSION['message_type'] = 'success';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = 'Erreur lors de la mise à jour de la commande.';
            $_SESSION['message_type'] = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifie une commande détaillée</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
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
            <h2>Modifie une commande détaillée</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message ' . htmlspecialchars($_SESSION['message_type']) . '">';
                echo htmlspecialchars($_SESSION['message']);
                echo '</div>';
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <div class="form">
            <form action="edit.php?id=<?php echo $commande['id']; ?>" method="POST" enctype="multipart/form-data" class="formulaire-creation-compte">
            <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="name" id="nom" name="nom" class="input-field"value="<?php echo htmlspecialchars($commande['nom']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="name" id="prenom" name="prenom" class="input-field" value="<?php echo htmlspecialchars($commande['prenom']); ?>" required>
                    </div>
                    </div> 
                    <div class="form-row">
                    <div class="form-group">
                        <label for="prix">Prix total (en €)</label>
                        <input type="number" id="prix" name="prix" class="input-field" value="<?php echo htmlspecialchars($commande['prix']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="text">Commentaire</label>
                        <textarea id="text" name="commentaire" value="<?php echo htmlspecialchars($commande['commentaire']); ?>" class="input-field"></textarea>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date de création</label>
                        <input type="datetime-local" id="date" name="date" value="<?php echo htmlspecialchars($commande['date']); ?>" class="input-field" required>
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
                    <input type="number" id="client" name="client" class="input-field" value="<?php echo htmlspecialchars($commande['id_client']); ?>"required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="structure">ID Structure</label>
                    <input type="number" id="structure"  name="structure" class="input-field" value="<?php echo htmlspecialchars($commande['id_structure']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dimension">ID Dimension</label>
                    <input type="number" id="dimension" name="dimension" class="input-field" value="<?php echo htmlspecialchars($commande['id_dimension']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="banquette">ID Type banquette</label>
                    <input type="number" id="banquette" name="banquette" class="input-field" value="<?php echo htmlspecialchars($commande['id_banquette']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="mousse">ID Mousse</label>
                    <input type="number" id="mousse" name="mousse" class="input-field" value="<?php echo htmlspecialchars($commande['id_mousse']); ?>" required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurBois">ID Couleur bois</label>
                    <input type="number" id="couleurbois" name="couleurbois" class="input-field" value="<?php echo htmlspecialchars($commande['id_couleur_bois']); ?>" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="decoration">ID Décoration bois</label>
                    <input type="number" id="decoration" name="decoration" class="input-field" value="<?php echo htmlspecialchars($commande['id_decoration']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirBois">ID Accoudoir bois</label>
                    <input type="number" id="accoudoirbois" name="accoudoirbois" class="input-field" value="<?php echo htmlspecialchars($commande['id_accoudoir_bois']); ?>" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossierBois">ID Dossier bois</label>
                    <input type="number" id="dossierbois" name="dossierbois"  class="input-field" value="<?php echo htmlspecialchars($commande['id_dossier_bois']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurtissuBois">ID Couleur tissu bois</label>
                    <input type="number" id="couleurtissubois" name="couleurtissubois" class="input-field" value="<?php echo htmlspecialchars($commande['id_couleur_tissu_bois']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motifBois">ID Motif bois</label>
                    <input type="number" id="motifbois" name="motifbois" class="input-field" value="<?php echo htmlspecialchars($commande['id_motif_bois']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="modele">ID Modèle banquette tissu</label>
                    <input type="number" id="modele" name="modele" class="input-field" value="<?php echo htmlspecialchars($commande['id_modele']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurTissu">ID Couleur tissu</label>
                    <input type="number" id="couleurtissu" name="couleurtissu" class="input-field" value="<?php echo htmlspecialchars($commande['id_couleur_tissu']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motifTissu">ID Motif tissu</label>
                    <input type="number" id="motiftissu" name="motiftissu" class="input-field" value="<?php echo htmlspecialchars($commande['id_motif_tissu']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossierTissu">ID Dossier tissu</label>
                    <input type="number" id="dossiertissu" name="dossiertissu"  class="input-field" value="<?php echo htmlspecialchars($commande['id_dossier_tissu']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirTissu">ID Accoudoir tissu</label>
                    <input type="number" id="accoudoirtissu" name="accoudoirtissu" class="input-field" value="<?php echo htmlspecialchars($commande['id_accoudoir_tissu']); ?>">
                    </div>
                    </div>
                    <div class="footer">
                        <div class="buttons">
                        <button type="button" class="btn-retour" onclick="history.go(-1)">Retour</button>
                        <input type="submit" class="btn-valider" value="Mettre à jour"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</body>
</html