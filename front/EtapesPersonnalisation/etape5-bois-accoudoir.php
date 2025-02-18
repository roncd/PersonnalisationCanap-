<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types d'accoudoirs depuis la base de données
$stmt = $pdo->query("SELECT * FROM accoudoir_bois");
$accoudoir_bois = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 5 - Ajoute tes accoudoirs</title>
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
    <li><a href="etape5-bois-accoudoir.php" class="active">Accoudoirs</a></li>
    <li><a href="etape6-bois-dossier.php">Dossier</a></li>
    <li><a href="etape7-bois-mousse.php">Mousse</a></li>
    <li><a href="etape8-1-bois-tissu.php">Tissu</a></li>
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 5 - Ajoute tes accoudoirs</h2>
      
      <section class="color-options">
      <?php if (!empty($accoudoir_bois)): ?>
        <?php foreach ($accoudoir_bois as $accoudoir): ?>
          <div class="option transition">
              <img src="../../admin/uploads/accoudoirs-bois/<?php echo htmlspecialchars($accoudoir['img']); ?>" alt="<?php echo htmlspecialchars($accoudoir['nom']); ?>">
              <p><?php echo htmlspecialchars($accoudoir['nom']); ?></p>
              <p><strong><?php echo htmlspecialchars($accoudoir['prix']); ?> €</strong></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Aucun accoudoir disponible pour le moment.</p>
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

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const openButton = document.querySelector('.btn-aide'); // Bouton pour ouvrir le popup
    const popup = document.getElementById('help-popup');
    const closeButton = document.querySelector('.close-btn'); // Bouton "Merci !" pour fermer le popup

    // Afficher le popup
    openButton.addEventListener('click', () => {
      popup.style.display = 'flex';
    });

    // Masquer le popup avec le bouton "Merci !"
    closeButton.addEventListener('click', () => {
      popup.style.display = 'none';
    });

    // Fermer le popup si clic à l'extérieur
    window.addEventListener('click', (event) => {
      if (event.target === popup) {
        popup.style.display = 'none';
      }
    });
  });
  </script>

  <!-- Popup abandonner -->
  <div id="abandonner-popup" class="popup transition">
    <div class="popup-content">
      <h2>Êtes vous sûr de vouloir abandonner ?</h2>
        <br>
      <button class="yes-btn">Oui ...</button>
      <button class="no-btn">Non !</button>
    </div>
  </div>
  
  

  <div id="selection-popup" class="popup transition">
    <div class="popup-content">
      <h2>Veuillez choisir une option avant de continuer.</h2>
      <br>
      <button class="close-btn">OK</button>
      </div>
  </div>

  <script>
   document.addEventListener('DOMContentLoaded', () => {
  const options = document.querySelectorAll('.color-options .option img'); 
  const mainImage = document.querySelector('.main-display img'); 
  const suivantButton = document.querySelector('.btn-suivant');
  const helpPopup = document.getElementById('help-popup');
  const abandonnerPopup = document.getElementById('abandonner-popup');
  const selectionPopup = document.getElementById('selection-popup');
  let selected = false; 

  document.querySelectorAll('.transition').forEach(element => {
    element.classList.add('show'); 
  });

  options.forEach(img => {
    img.addEventListener('click', () => {
      options.forEach(opt => opt.classList.remove('selected'));
      img.classList.add('selected');
      mainImage.src = img.src;
      selected = true;  
    });
  });

  suivantButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (!selected) {
      selectionPopup.style.display = 'flex';
    } else {
      document.body.classList.remove('show');
      setTimeout(() => {
        window.location.href = 'etape6-bois-dossier.php';
      }, 500);
    }
  });

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

  document.querySelector('#selection-popup .close-btn').addEventListener('click', () => {
    selectionPopup.style.display = 'none';
  });

});
  </script>
</main>

<?php require_once '../../squelette/footer.php' ?>
</body>
</html>
