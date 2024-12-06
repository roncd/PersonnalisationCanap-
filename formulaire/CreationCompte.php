<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/formulaire.css">
  <title>Créer ton compte</title>
</head>
<body>

<header>
  <?php require '../squelette/header.php'; ?>
</header>

<main>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Créer ton compte</h2>
      <form class="formulaire-creation-compte">
        <div class="form-row">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom"  class="input-field">
          </div>
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" class="input-field">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="adresse">Adresse mail</label>
            <input type="text" id="adresse"  class="input-field">
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" class="input-field">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse"class="input-field">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="adresse-livraison">Adresse de livraison</label>
            <input type="text" id="adresse-livraison" class="input-field">
          </div>
          <div class="form-group">
            <label for="infos-supplementaires">Informations supplémentaires</label>
            <input type="text" id="infos-supplementaires" class="input-field">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="code-postal">Code postal</label>
            <input type="text" id="code-postal" class="input-field">
          </div>
          <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" id="ville"  class="input-field">
          </div>
        </div>
      </form>
      <div class="footer">
        <p>Tu as déjà un compte ? <span><a href="https://diangou-cmr.alwaysdata.net/processus-personalisation/formulaire/Connexion.php#" class="link-connect">Connecte-toi</a></span></p>
        <div class="buttons">
          <button class="btn-retour">Retour</button>
          <button class="btn-valider">Valider</button>
        </div>
      </div>
    </div>

    <!-- Colonne de droite avec l'image -->
    <div class="right-column">
      <section class="main-display">
        <img src="../medias/meknes.png" alt="Armoire">
      </section>
    </div>
  </div>
</main>

</body>
</html>
