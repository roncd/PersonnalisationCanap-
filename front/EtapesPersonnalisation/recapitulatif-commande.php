<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">
  <title>Récapitulatif de la commande</title>
  <style>
    .footer p {
      margin-bottom: 20px; /* Augmente l'espace entre le texte et les boutons */
    }
  </style>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Récapitulatif de la commande</h2><section class="color-options">
  <h3>Étape 1 : Choisi ta structure</h3>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Armoire">
    <p>Armoire</p>
    <span>20 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Tissu">
    <p>Tissu</p>
    <span>30 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Torsade">
    <p>Torsade</p>
    <span>40 €</span>
  </div>

  <h3>Étape 1 : Choisi tes dimensions</h3>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 4">
    <p>Option 4</p>
    <span>50 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 5">
    <p>Option 5</p>
    <span>60 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 6">
    <p>Option 6</p>
    <span>70 €</span>
  </div>

  <h3>Étape 2 : Choisi ton type de banquette</h3>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 7">
    <p>Option 7</p>
    <span>80 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 8">
    <p>Option 8</p>
    <span>90 €</span>
  </div>
  <div class="option">
    <img src="../../medias/canape.jpg" alt="Option 9">
    <p>Option 9</p>
    <span>100 €</span>
  </div>
</section>


      <div class="footer-processus">
          <p>Total : <span>899 €</span></p>
          <div class="buttons">
            <button class="btn-retour">Retour</button>
            <button class="btn-suivant">Générer un devis</button>
          </div>
        </div>
    </div>

    <!-- Colonne de droite -->
    <div class="right-column">
      <section class="main-display-recap">
        <div class="buttons">
          <button class="btn-aide">Besoin d'aide ?</button>
          <button class="btn-abandonner">Abandonner</button>
        </div>
        <img src="../../medias/canapekenitra.png" alt="Armoire">

        
      <!-- Section commentaire -->
      <section class="comment-section">
      <h3>Ajoute un commentaire à propos de ta commande :                     </h3>
      <textarea class="textarea-custom" name="comment" rows="5" placeholder="Écris ton commentaire ici..."></textarea>
      <button class="btn-submit-com">Ajouter</button>

      </section>
       
      </section>
      
    </div>
  </div>
  
<!-- Popup besoin d'aide -->
<div id="help-popup" class="popup">
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

<!-- Popup abandonner -->
<div id="abandonner-popup" class="popup">
  <div class="popup-content">
    <h2>Êtes vous sûr de vouloir abandonner ?</h2>
      <br>
    <button class="yes-btn">Oui ...</button>
    <button class="no-btn">Non !</button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
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

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // Sélection des boutons
    const retourButton = document.querySelector('.btn-retour');
    const suivantButton = document.querySelector('.btn-suivant');

    // Action du bouton "Retour" : rediriger vers la page précédente
    retourButton.addEventListener('click', () => {
      window.history.back(); // Navigue vers la page précédente
    });

    // Action du bouton "Suivant" : rediriger vers la page suivante
    suivantButton.addEventListener('click', () => {
      window.location.href = 'recapitulatif-commande.php'; // Remplacez par le lien de la page suivante
    });
  });
</script>

</main>

<?php require_once '../../squelette/footer.php'; ?>
</body>
</html>
