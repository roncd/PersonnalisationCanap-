<<<<<<< HEAD
<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les types de banquette depuis la base de données
$stmt = $pdo->query("SELECT * FROM accoudoir_tissu");
$accoudoir_tissu = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
=======
>>>>>>> 756440a8fbd9349ef14ea7ebc3ee10bb957b4129
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
<<<<<<< HEAD
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Étape 6 - Ajoute tes accoudoirs</title>
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
=======

  <title>Étape 6 - Ajoute tes accoudoirs</title>
>>>>>>> 756440a8fbd9349ef14ea7ebc3ee10bb957b4129
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
<div class="fil-ariane-container" aria-label="fil-ariane">
<<<<<<< HEAD
<ul class="fil-ariane">
  <li><a href="etape1-1-structure.php">Structure</a></li>
    <li><a href="etape1-2-dimension.php">Dimension</a></li>
    <li><a href="etape2-type-banquette.php">Banquette</a></li>
    <li><a href="etape3-tissu-modele-banquette.php" >Modèle</a></li>
    <li><a href="etape4-1-tissu-choix-tissu.php">Tissu</a></li>
    <li><a href="etape5-tissu-choix-dossier.php" >Dossier</a></li>
    <li><a href="etape6-1-tissu-accoudoir.php" class="active">Accoudoir</a></li>
    <li><a href="etape7-tissu-choix-mousse.php">Mousse</a></li>
=======
  <ul class="fil-ariane">
    <li><a href="etape1-1.php">Structure</a></li>
    <li><a href="etape2.php">Banquette</a></li>
    <li><a href="etape3-tissu.php">Modèle</a></li>
    <li><a href="etape4-1-tissu.php">Tissu</a></li>
    <li><a href="etape5-tissu.php">Dossier</a></li>
    <li><a href="etape6-1-tissu.php" class="active">Accoudoir</a></li>
    <li><a href="etape7-tissu.php">Mousse</a></li>
>>>>>>> 756440a8fbd9349ef14ea7ebc3ee10bb957b4129
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
<<<<<<< HEAD
    <div class="left-column transition">
      <h2>Étape 6 - Ajoute tes accoudoirs</h2>
      
      <section class="color-2options">
      <?php if (!empty($accoudoir_tissu)): ?>
      <?php foreach ($accoudoir_tissu as $accoudoir_tissu): ?>
        <div class="option transition">
            <img src="../../admin/uploads/accoudoirs-tissu/<?php echo htmlspecialchars($accoudoir_tissu['img']); ?>" alt="<?php echo htmlspecialchars($accoudoir_tissu['nom']); ?>">
            <p><?php echo htmlspecialchars($accoudoir_tissu['nom']); ?></p>
            <p><strong><?php echo htmlspecialchars($accoudoir_tissu['prix']); ?> €</strong></p>
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
        window.location.href = 'etape7-tissu-choix-mousse.php'; 
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
  const options = document.querySelectorAll('.color-2options .option img'); // Sélectionne toutes les images
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


<script>document.addEventListener('DOMContentLoaded', () => {
  const openButton = document.querySelector('.btn-abandonner'); // Bouton pour ouvrir le popup
  const popup = document.getElementById('abandonner-popup');
  const yesButton = document.querySelector('.yes-btn'); // Bouton "Oui ..." pour redirection
  const noButton = document.querySelector('.no-btn'); // Bouton "Non !" pour fermer le popup

  // Afficher le popup
  openButton.addEventListener('click', () => {
    console.log('Bouton Abandonner cliqué');
    popup.style.display = 'flex';
  });

  // Rediriger vers la page d'accueil avec le bouton "Oui ..."
  yesButton.addEventListener('click', () => {
    document.body.classList.remove('show');
    setTimeout(() => {
      window.location.href = '../pages/';
    }, 500);
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
=======
    <div class="left-column">
      <h2>Étape 6 - Ajoute tes accoudoirs</h2>
      
      <section class="color-options">
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Armoire">
          <p>Armoire</p>
          <span>20 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Tissu">
          <p>Tissu</p>
          <span>30 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Torsade">
          <p>Torsade</p>
          <span>40 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 4">
          <p>Option 4</p>
          <span>50 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 5">
          <p>Option 5</p>
          <span>60 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 6">
          <p>Option 6</p>
          <span>70 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 7">
          <p>Option 7</p>
          <span>80 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 8">
          <p>Option 8</p>
          <span>90 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 9">
          <p>Option 9</p>
          <span>100 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 7">
          <p>Option 7</p>
          <span>80 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 8">
          <p>Option 8</p>
          <span>90 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 9">
          <p>Option 9</p>
          <span>100 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 7">
          <p>Option 7</p>
          <span>80 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 8">
          <p>Option 8</p>
          <span>90 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 9">
          <p>Option 9</p>
          <span>100 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 7">
          <p>Option 7</p>
          <span>80 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 8">
          <p>Option 8</p>
          <span>90 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 9">
          <p>Option 9</p>
          <span>100 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 7">
          <p>Option 7</p>
          <span>80 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 8">
          <p>Option 8</p>
          <span>90 €</span>
        </div>
        <div class="option">
          <img src="../../medias/boisnoir.jpeg" alt="Option 9">
          <p>Option 9</p>
          <span>100 €</span>
        </div>
        
      </section>

      <div class="footer">
        <p>Total : <span>899 €</span></p>
        <div class="buttons">
          <button class="btn-retour">Retour</button>
          <button href="etape7-tissu.php" class="btn-suivant">Suivant</button>
        </div>
      </div>
    </div>

    <!-- Colonne de droite -->
    <div class="right-column">
      <section class="main-display">
        <div class="buttons">
          <button class="btn-aide" onclick="history.go(-1)">Besoin d'aide ?</button>
          <button class="btn-abandonner">Abandonner</button>
        </div>
        <img src="../../medias/boisnoir.jpeg" alt="Armoire">
      </section>
    </div>
  </div>
</main>
<?php require_once '../../squelette/footer.php'?>
</body>
</html>
>>>>>>> 756440a8fbd9349ef14ea7ebc3ee10bb957b4129
