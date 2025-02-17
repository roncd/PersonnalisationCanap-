<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types de mousse depuis la base de données
$stmt = $pdo->query("SELECT * FROM mousse");
$mousse = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 7 - Choisi ta mousse</title>
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
    <li><a href="etape3-tissu-modele-banquette.php" >Modèle</a></li>
    <li><a href="etape4-1-tissu-choix-tissu.php">Tissu</a></li>
    <li><a href="etape5-tissu-choix-dossier.php">Dossier</a></li>
    <li><a href="etape6-1-tissu-accoudoir.php">Accoudoir</a></li>
    <li><a href="etape7-tissu-choix-mousse.php" class="active">Mousse</a></li>
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column transition">
      <h2>Étape 7 - Choisi ta mousse</h2>
      
      <section class="color-options">
      <?php if (!empty($mousse)): ?>
      <?php foreach ($mousse as $mousse): ?>
        <div class="option transition">
            <img src="../../admin/uploads/mousse/<?php echo htmlspecialchars($mousse['img']); ?>" alt="<?php echo htmlspecialchars($mousse['nom']); ?>">
            <p><?php echo htmlspecialchars($mousse['nom']); ?></p>
            <p><strong><?php echo htmlspecialchars($mousse['prix']); ?> €</strong></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune mousse disponible pour le moment.</p>
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
        window.location.href = 'recapitulatif-commande.php'; 
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
  <script>
document.addEventListener('DOMContentLoaded', () => {
  const openButton = document.querySelector('.btn-aide'); // Bouton pour ouvrir le popup
  const popup = document.getElementById('help-popup');
  const closeButton = document.querySelector('.close-btn'); // Bouton "Merci !" pour fermer le popup

  // Afficher le popup
  openButton.addEventListener('click', () => {
    console.log('Bouton Aide cliqué');
    popup.style.display = 'flex';
  });

  // Masquer le popup avec le bouton "Merci !"
  closeButton.addEventListener('click', () => {
    console.log('Bouton Merci cliqué');
    popup.style.display = 'none';
  });

  // Fermer le popup si clic à l'extérieur
  window.addEventListener('click', (event) => {
    if (event.target === popup) {
      console.log('Clic à l\'extérieur du popup');
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


<script>
document.addEventListener('DOMContentLoaded', () => {
  const options = document.querySelectorAll('.color-options .option img'); // Sélectionne toutes les images
  const mainImage = document.querySelector('.main-display img');
  const openButton = document.querySelector('.btn-aide'); // Bouton pour ouvrir le popup
  const popup = document.getElementById('help-popup');
  const closeButton = document.querySelector('.close-btn'); // Bouton "Merci !" pour fermer le popup

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

  // Afficher le popup
  openButton.addEventListener('click', () => {
    console.log('Bouton Abandonner cliqué');
    popup.style.display = 'flex';
  });

  // Rediriger vers la page d'accueil avec le bouton "Oui ..."
  yesButton.addEventListener('click', () => {
    console.log('Redirection vers la page d\'accueil');
    window.location.href = '../pages/'; // Remplace '/' par l'URL de votre page d'accueil
  });

  // Masquer le popup avec le bouton "Non !"
  noButton.addEventListener('click', () => {
    console.log('Popup fermé via le bouton Non !');
    popup.style.display = 'none';
  });

  // Fermer le popup si clic à l'extérieur
  window.addEventListener('click', (event) => {
    if (event.target === popup) {
      console.log('Clic à l\'extérieur du popup');
      popup.style.display = 'none';
    }
  });
});
</script>
</main>
<?php require_once '../../squelette/footer.php'?>
</body>
</html>
