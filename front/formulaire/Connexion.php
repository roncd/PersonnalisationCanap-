<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/formulaire.css">
  <title>Connexion</title>
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Connexion</h2>
      <form class="formulaire-creation-compte">
        <div class="form-row">
          <div class="form-group">
            <label for="adresse">Adresse mail</label>
            <input type="email" id="adresse"  class="input-field" require>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse"  class="input-field" require>
          </div>
        </div>
      </form>
      <div class="footer">
        <p>Tu n'as pas de compte ? <span><a href="CreationCompte.php" class="link-connect">Inscris-toi</a></span></p>
        <div class="buttons">
          <button class="btn-retour" onclick="history.go(-1)">Retour</button>
          <button class="btn-valider">Valider</button>
        </div>
      </div>
    </div>

    <!-- Colonne de droite avec l'image -->
    <div class="right-column">
      <section class="main-display">
        <img src="../../medias/meknes.png" alt="Image d'illustration">
      </section>
    </div>
  </div>
</main>
<?php require_once '../../squelette/footer.php'?>
</body>


</html>
