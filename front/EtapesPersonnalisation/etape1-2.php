<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">


  <title>Étape 1 - Choisi tes mesures</title>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
<div class="fil-ariane-container" aria-label="fil-ariane">
  <ul class="fil-ariane">
    <li><a href="etape1-1.php" class="active">Structure</a></li>
    <li><a href="etape2.php">Banquette</a></li>
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Étape 1 - Choisi tes mesures</h2>
      
      <form class="formulaire-creation-compte">
      <p>Largeur banquette : <span class="bold">50cm (par défaut)</span></p>
          <div class="form-row">
           
            <div class="form-group">
              <label for="longueurA">Longueur banquette A (en cm) :</label>
              <input type="number" id="longueurA"  class="input-field" require>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="longueurB">Longueur banquette B (en cm) :</label>
              <input type="number" id="longueurB"  class="input-field" require>
            </div>
          </div>
      </form>
      


      <div class="footer">
        <p>Total : <span>899 €</span></p>
        <div class="buttons">
          <button class="btn-retour" onclick="history.go(-1)">Retour</button>
          <button class="btn-suivant">Suivant</button>
        </div>
      </div>
    </div>

    <!-- Colonne de droite -->
    <div class="right-column">
      <section class="main-display">
        <div class="buttons">
          <button class="btn-aide">Besoin d'aide ?</button>
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
