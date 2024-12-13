<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">

  <title>Étape 6 - Choisi ton nombre d'accoudoirs</title>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Étape 6 - Choisi ton nombre d'accoudoirs</h2>
      
      <form class="formulaire-creation-compte">
          <div class="form-row">
            <div class="form-group">
              <label for="accoudoir">Nombre d'accoudoirs :</label>
              <input type="number" id="accoudoir"  class="input-field" require>
            </div>
          </div>
      </form>

      <div class="footer">
        <p>Total : <span>899 €</span></p>
        <div class="buttons">
          <button class="btn-retour">Retour</button>
          <button class="btn-suivant">Suivant</button>
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
