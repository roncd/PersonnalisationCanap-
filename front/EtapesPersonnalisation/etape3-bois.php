<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  
  <title>Étape 3 - Choisi ta couleur</title>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
<div class="fil-ariane-container" aria-label="fil-ariane">
  <ul class="fil-ariane">
    <li><a href="etape1-1.php">Structure</a></li>
    <li><a href="etape2.php">Banquette</a></li>
    <li><a href="etape3-bois.php" class="active">Couleur</a></li>
    <li><a href="etape4-bois.php">Décoration</a></li>
    <li><a href="etape5-1-bois.php">Accoudoirs</a></li>
    <li><a href="etape6-bois.php">Dossier</a></li>
    <li><a href="etape7-bois.php">Mousse</a></li>
    <li><a href="etape8-1-bois.php">Tissu</a></li>
  </ul>
</div>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Étape 3 - Choisi ta couleur</h2>
      
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
