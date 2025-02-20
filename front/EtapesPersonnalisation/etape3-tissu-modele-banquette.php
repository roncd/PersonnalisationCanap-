<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types de banquette depuis la base de données
$stmt = $pdo->query("SELECT * FROM modele");
$modele = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 3 - Choisi ton modèle</title>
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
    <li><a href="etape3-tissu-modele-banquette.php" class="active">Modèle</a></li>
    <li><a href="etape4-1-tissu-choix-tissu.php">Tissu</a></li>
    <li><a href="etape5-tissu-choix-dossier.php">Dossier</a></li>
    <li><a href="etape6-2-tissu.php">Accoudoir</a></li>
    <li><a href="etape7-tissu-choix-mousse.php">Mousse</a></li>
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 3 - Choisi ton modèle</h2>
      
      <section class="color-2options">
      <?php if (!empty($modele)): ?>
    <?php foreach ($modele as $modele): ?>
        <div class="option transition">
            <img src="../../admin/uploads/modele/<?php echo htmlspecialchars($modele['img']); ?>" alt="<?php echo htmlspecialchars($modele['nom']); ?>">
            <p><?php echo htmlspecialchars($modele['nom']); ?></p>
            <p><strong><?php echo htmlspecialchars($modele['prix']); ?> €</strong></p>
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
        <img src="../../medias/process-main-image.png" alt="Armoire" class="transition">
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
  


<!-- Popup besoin d'aide -->
<div id="abandonner-popup" class="popup transition">
  <div class="popup-content">
    <h2>Êtes vous sûr de vouloir abandonner ?</h2>
      <br>
    <button class="yes-btn">Oui ...</button>
    <button class="no-btn">Non !</button>
  </div>
</div>

<!-- Pop-up de sélection d'option -->
<div id="selection-popup" class="popup transition">
  <div class="popup-content">
    <h2>Veuillez choisir une option avant de continuer.</h2>
    <br>
    <button class="close-btn">OK</button>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Sélectionner les éléments nécessaires
  const options = document.querySelectorAll('.color-2options .option img'); // Les images des options
  const mainImage = document.querySelector('.main-display img'); // L'image affichée en grand
  const suivantButton = document.querySelector('.btn-suivant'); // Le bouton "Suivant"
  const helpPopup = document.getElementById('help-popup'); // Pop-up besoin d'aide
  const abandonnerPopup = document.getElementById('abandonner-popup'); // Pop-up abandonner
  const selectionPopup = document.getElementById('selection-popup'); // Pop-up de sélection
  let selected = false; // Marque si une option a été sélectionnée

  // Appliquer les transitions aux éléments
  document.querySelectorAll('.transition').forEach(element => {
    element.classList.add('show');
  });

  // Gestion de la sélection des images
  options.forEach(img => {
    img.addEventListener('click', () => {
      // Retirer la classe "selected" de toutes les images
      options.forEach(opt => opt.classList.remove('selected'));
      // Ajouter la classe "selected" à l'image cliquée
      img.classList.add('selected');
      
      // Mettre à jour l'image principale
      mainImage.src = img.src;
      mainImage.alt = img.alt; // Ajouter l'attribut alt pour la description de l'image
      selected = true; // Marquer comme sélectionné
    });
  });

  // Action sur le bouton "Suivant"
  suivantButton.addEventListener('click', (event) => {
    event.preventDefault(); // Empêcher la redirection immédiate
    if (!selected) {
      // Si aucune option n'est sélectionnée, afficher le pop-up
      selectionPopup.style.display = 'flex';
    } else {
      // Si une option est sélectionnée, rediriger vers la page suivante
      document.body.classList.remove('show');
      setTimeout(() => {
        window.location.href = 'etape4-1-tissu-choix-tissu.php'; // Redirection vers l'étape suivante
      }, 500);
    }
  });

  // Fermeture du pop-up de sélection
  document.querySelector('#selection-popup .close-btn').addEventListener('click', () => {
    selectionPopup.style.display = 'none'; // Fermer le pop-up
  });

  // Option supplémentaire : fermer le pop-up de sélection si clic à l'extérieur
  window.addEventListener('click', (event) => {
    if (event.target === selectionPopup) {
      selectionPopup.style.display = 'none';
    }
  });

  // Gestion du pop-up "Besoin d'aide"
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

  // Gestion du pop-up "Abandonner"
  document.querySelector('.btn-abandonner').addEventListener('click', () => {
    abandonnerPopup.style.display = 'flex';
  });

  // Si l'utilisateur clique sur "Oui" pour abandonner
  document.querySelector('#abandonner-popup .yes-btn').addEventListener('click', () => {
    document.body.classList.remove('show');
    setTimeout(() => {
      window.location.href = '../pages/'; // Redirection en cas d'abandon
    }, 500);
  });

  // Si l'utilisateur clique sur "Non" pour annuler l'abandon
  document.querySelector('#abandonner-popup .no-btn').addEventListener('click', () => {
    abandonnerPopup.style.display = 'none'; // Fermer le pop-up d'abandon
  });

  // Fermer le pop-up d'abandon si clic à l'extérieur
  window.addEventListener('click', (event) => {
    if (event.target === abandonnerPopup) {
      abandonnerPopup.style.display = 'none';
    }
  });
});
</script>




</main>
<?php require_once '../../squelette/footer.php'?>

</body>
</html>
