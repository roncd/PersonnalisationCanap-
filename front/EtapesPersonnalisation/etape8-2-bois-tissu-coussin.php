<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les motifs de bois depuis la base de données
$stmt = $pdo->query("SELECT * FROM motif_bois");
$motif_bois = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">

  <title>Étape 8 - Choisi ton motif de coussin</title>
  <style>
    /* Transition pour les éléments de la page */
    .transition {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .transition.show {
      opacity: 1;
      transform: translateY(0);
    }

    /* Appliquer les transitions aux images sélectionnées */
    .option img.selected {
      border: 3px solid #997765; /* Couleur marron */
      border-radius: 5px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
<div class="fil-ariane-container" aria-label="fil-ariane">
  <ul class="fil-ariane">
    <li><a href="etape1-1-structure.php">Structure</a></li>
    <li><a href="etape1-2-dimension.php">Dimension</a></li>
    <li><a href="etape2-type-banquette.php">Banquette</a></li>
    <li><a href="etape3-bois-couleur.php">Couleur</a></li>
    <li><a href="etape4-bois-decoration.php">Décoration</a></li>
    <li><a href="etape5-bois-accoudoir.php">Accoudoirs</a></li>
    <li><a href="etape6-bois-dossier.php">Dossier</a></li>
    <li><a href="etape7-bois-mousse.php">Mousse</a></li>
    <li><a href="etape8-1-bois-tissu.php" class="active">Tissu</a></li>
  </ul>
</div>

  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 8 - Choisi ton motif de coussin</h2>
      
      <section class="color-options">
        <?php if (!empty($motif_bois)): ?>
          <?php foreach ($motif_bois as $motif_bois): ?>
            <div class="option transition">
              <img src="../../admin/uploads/motif-bois/<?php echo htmlspecialchars($motif_bois['img']); ?>" alt="<?php echo htmlspecialchars($motif_bois['nom']); ?>">
              <p><?php echo htmlspecialchars($motif_bois['nom']); ?></p>
              <p><strong><?php echo htmlspecialchars($motif_bois['prix']); ?> €</strong></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun motif de coussin disponible pour le moment.</p>
        <?php endif; ?>   
      </section>

      <div class="footer">
        <p>Total : <span>899 €</span></p>
        <div class="buttons">
          <button class="btn-retour transition" onclick="history.go(-1)">Retour</button>
          <button class="btn-suivant transition">Suivant</button>
        </div>
      </div>
    </div>

    <!-- Colonne de droite -->
    <div class="right-column transition">
      <section class="main-display">
        <div class="buttons">
          <button class="btn-aide">Besoin d'aide ?</button>
          <button class="btn-abandonner">Abandonner</button>
        </div>
        <img src="../../medias/boisnoir.jpeg" alt="Armoire">
      </section>
    </div>
  </div>

  <!-- Popup besoin d'aide -->
  <div id="help-popup" class="popup transition">
    <div class="popup-content">
      <h2>Vous avez une question ?</h2>
      <p>Contactez-nous au numéro suivant et un vendeur vous assistera :
        <br><br>
        <strong>06 58 47 58 56</strong></p>
        <br>
      <button class="close-btn">Merci !</button>
    </div>
  </div>

  <!-- Popup abandonner -->
  <div id="abandonner-popup" class="popup transition">
    <div class="popup-content">
      <h2>Êtes-vous sûr de vouloir abandonner ?</h2>
      <br>
      <button class="yes-btn">Oui ...</button>
      <button class="no-btn">Non !</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Afficher les éléments avec la classe "transition"
      document.querySelectorAll('.transition').forEach(element => {
        element.classList.add('show');
      });

      // Sélection des images de motif bois
      const options = document.querySelectorAll('.color-options .option img');
      const mainImage = document.querySelector('.main-display img');

      options.forEach(img => {
        img.addEventListener('click', () => {
          // Supprime la classe "selected" de toutes les images
          options.forEach(opt => opt.classList.remove('selected'));

          // Ajoute la classe "selected" à l'image cliquée
          img.classList.add('selected');

          // Met à jour l'image principale
          mainImage.src = img.src;
          mainImage.alt = img.alt;
        });
      });

      // Afficher le popup
      const openButton = document.querySelector('.btn-aide');
      const popup = document.getElementById('help-popup');
      const closeButton = document.querySelector('.close-btn');

      openButton.addEventListener('click', () => {
        popup.style.display = 'flex';
      });

      closeButton.addEventListener('click', () => {
        popup.style.display = 'none';
      });

      // Fermer le popup si clic à l'extérieur
      window.addEventListener('click', (event) => {
        if (event.target === popup) {
          popup.style.display = 'none';
        }
      });

      // Popup abandonner
      const abandonButton = document.querySelector('.btn-abandonner');
      const abandonPopup = document.getElementById('abandonner-popup');
      const yesButton = document.querySelector('.yes-btn');
      const noButton = document.querySelector('.no-btn');

      abandonButton.addEventListener('click', () => {
        abandonPopup.style.display = 'flex';
      });

      yesButton.addEventListener('click', () => {
        window.location.href = '../pages/';
      });

      noButton.addEventListener('click', () => {
        abandonPopup.style.display = 'none';
      });

      // Fermer le popup abandonner si clic à l'extérieur
      window.addEventListener('click', (event) => {
        if (event.target === abandonPopup) {
          abandonPopup.style.display = 'none';
        }
      });

      // Action du bouton "Suivant"
      const suivantButton = document.querySelector('.btn-suivant');
      suivantButton.addEventListener('click', () => {
        window.location.href = 'recapitulatif-commande.php';
      });
    });
  </script>
</main>

<?php require_once '../../squelette/footer.php' ?>
</body>
</html>
