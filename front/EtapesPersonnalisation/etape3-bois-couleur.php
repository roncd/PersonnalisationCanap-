<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types de bois depuis la base de données
$stmt = $pdo->query("SELECT * FROM couleur_bois");
$couleur_bois = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 3 - Choisi ta couleur</title>
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
      <li><a href="etape3-bois-couleur.php" class="active">Couleur</a></li>
      <li><a href="etape4-bois-decoration.php">Décoration</a></li>
      <li><a href="etape5-bois-accoudoir.php">Accoudoirs</a></li>
      <li><a href="etape6-bois-dossier.php">Dossier</a></li>
      <li><a href="etape7-bois-mousse.php">Mousse</a></li>
      <li><a href="etape8-1-bois-tissu.php">Tissu</a></li>
    </ul>
  </div>

  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 3 - Choisi ta couleur</h2>

      <section class="color-options">
        <?php if (!empty($couleur_bois)): ?>
          <?php foreach ($couleur_bois as $couleur_bois): ?>
            <div class="option transition">
              <img src="../../admin/uploads/couleur-banquette-bois/<?php echo htmlspecialchars($couleur_bois['img']); ?>" alt="<?php echo htmlspecialchars($couleur_bois['nom']); ?>">
              <p><?php echo htmlspecialchars($couleur_bois['nom']); ?></p>
              <p><strong><?php echo htmlspecialchars($couleur_bois['prix']); ?> €</strong></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucune couleur disponible pour le moment.</p>
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

    <script>
    document.addEventListener('DOMContentLoaded', () => {
    // Afficher les éléments avec la classe "transition"
    document.querySelectorAll('.transition').forEach(element => {
      element.classList.add('show');
    });

    // Sélection des boutons
    const suivantButton = document.querySelector('.btn-suivant');

    // Action du bouton "Suivant" : rediriger vers la page suivante
    suivantButton.addEventListener('click', () => {
      document.body.classList.remove('show');
      setTimeout(() => {
        window.location.href = 'etape4-bois-decoration.php';
      }, 500);
    });
    });
    </script>

    <!-- Colonne de droite -->
    <div class="right-column transition">
      <section class="main-display">
        <div class="buttons transition">
          <button class="btn-aide">Besoin d'aide ?</button>
          <button class="btn-abandonner">Abandonner</button>
        </div>
        <img src="../../medias/boisnoir.jpeg" alt="Armoire" class="transition">
      </section>
    </div>
  </div>

  <!-- Popup besoin d'aide -->
  <div id="help-popup" class="popup transition">
    <div class="popup-content">
      <h2>Vous avez une question ?</h2>
      <p>Contactez nous au numéro suivant et un vendeur vous assistera : 
        <br><br>
      <strong>06 58 47 58 56</strong></p>
      <br>
      <button class="close-btn">Merci !</button>
    </div>
  </div>

  <!-- Popup abandonner -->
  <div id="abandonner-popup" class="popup transition">
    <div class="popup-content">
      <h2>Êtes vous sûr de vouloir abandonner ?</h2>
      <br>
      <button class="yes-btn">Oui ...</button>
      <button class="no-btn">Non !</button>
    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('.color-options .option');
    const imgs = document.querySelectorAll('.color-options .option img');
    const mainImage = document.querySelector('.main-display img');
    const openButton = document.querySelector('.btn-aide'); // Bouton pour ouvrir le popup
    const popup = document.getElementById('help-popup');
    const closeButton = document.querySelector('.close-btn'); // Bouton "Merci !" pour fermer le popup
    const abandonPopup = document.getElementById('abandonner-popup');
    const yesButton = document.querySelector('.yes-btn'); // Bouton "Oui ..." pour redirection
    const noButton = document.querySelector('.no-btn'); // Bouton "Non !" pour fermer le popup

    // Appliquer la classe "show" pour activer la transition sur chaque option
    options.forEach(option => {
      option.classList.add('show');
    });

    // Gestion des options de bois
    imgs.forEach(img => {
      img.addEventListener('click', () => {
        // Supprime la classe "selected" de toutes les images
        imgs.forEach(opt => opt.classList.remove('selected'));
        // Ajoute la classe "selected" à l'image cliquée
        img.classList.add('selected');
        // Met à jour l'image principale
        mainImage.src = img.src;
        mainImage.alt = img.alt;
      });
    });

    // Afficher le popup d'aide
    openButton.addEventListener('click', () => {
      popup.style.display = 'flex';
    });

    // Masquer le popup d'aide avec le bouton "Merci !"
    closeButton.addEventListener('click', () => {
      popup.style.display = 'none';
    });

    // Fermer le popup d'aide si clic à l'extérieur
    window.addEventListener('click', (event) => {
      if (event.target === popup) {
        popup.style.display = 'none';
      }
    });

    // Afficher le popup d'abandon
    document.querySelector('.btn-abandonner').addEventListener('click', () => {
      abandonPopup.style.display = 'flex';
    });

    // Rediriger vers la page d'accueil avec le bouton "Oui ..."
    yesButton.addEventListener('click', () => {
      window.location.href = '../pages/';
    });

    // Masquer le popup d'abandon avec le bouton "Non !"
    noButton.addEventListener('click', () => {
      abandonPopup.style.display = 'none';
    });

    // Fermer le popup d'abandon si clic à l'extérieur
    window.addEventListener('click', (event) => {
      if (event.target === abandonPopup) {
        abandonPopup.style.display = 'none';
      }
    });
  });
  </script>

</main>

<?php require_once '../../squelette/footer.php'; ?>

</body>
</html>
