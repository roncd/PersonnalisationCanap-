<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types de banquette depuis la base de données
$stmt = $pdo->query("SELECT * FROM type_banquette");
$type_banquette = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 2 - Choisi ton type de banquette</title>
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
      <li><a href="etape2-type-banquette.php" class="active">Banquette</a></li>
    </ul>
  </div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 2 - Choisi ton type de banquette</h2>
      
      <section class="color-2options">
        <?php if (!empty($type_banquette)): ?>
          <?php foreach ($type_banquette as $type): ?>
            <div class="option transition">
              <img src="../../admin/uploads/banquette/<?php echo htmlspecialchars($type['img']); ?>" 
                   alt="<?php echo htmlspecialchars($type['nom']); ?>"
                   data-name="<?php echo htmlspecialchars($type['nom']); ?>">
              <p><?php echo htmlspecialchars($type['nom']); ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun type de banquette disponible pour le moment.</p>
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
      <h2>Êtes-vous sûr de vouloir abandonner ?</h2>
      <br>
      <button class="yes-btn">Oui ...</button>
      <button class="no-btn">Non !</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const options = document.querySelectorAll('.color-2options .option img'); // Sélectionne toutes les images
      const mainImage = document.querySelector('.main-display img'); // Image principale
      const suivantButton = document.querySelector('.btn-suivant');
      const helpPopup = document.getElementById('help-popup');
      const abandonnerPopup = document.getElementById('abandonner-popup');

      // Afficher les éléments avec la classe "transition"
      document.querySelectorAll('.transition').forEach(element => {
        element.classList.add('show');
      });

      // Gestion des options de banquette
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

      // Gestion du bouton Suivant
      suivantButton.addEventListener('click', () => {
        document.body.classList.remove('show');
        setTimeout(() => {
          window.location.href = 'etape3-tissu-modele-banquette.php';
        }, 500);
      });

      // Gestion du popup "Besoin d'aide"
      document.querySelector('.btn-aide').addEventListener('click', () => {
        helpPopup.style.display = 'flex';
      });

      document.querySelector('#help-popup .close-btn').addEventListener('click', () => {
        helpPopup.style.display = 'none';
      });

      window.addEventListener('click', (event) => {
        if (event.target === helpPopup) {
          helpPopup.style.display = 'none';
        }
      });

      // Gestion du popup "Abandonner"
      document.querySelector('.btn-abandonner').addEventListener('click', () => {
        abandonnerPopup.style.display = 'flex';
      });

      document.querySelector('#abandonner-popup .yes-btn').addEventListener('click', () => {
        document.body.classList.remove('show');
        setTimeout(() => {
          window.location.href = '../pages/';
        }, 500);
      });

      document.querySelector('#abandonner-popup .no-btn').addEventListener('click', () => {
        abandonnerPopup.style.display = 'none';
      });

      window.addEventListener('click', (event) => {
        if (event.target === abandonnerPopup) {
          abandonnerPopup.style.display = 'none';
        }
      });
    });
  </script>
</main>

<?php require_once '../../squelette/footer.php'; ?>
</body>
</html>
