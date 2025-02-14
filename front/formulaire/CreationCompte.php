<?php
require '../../admin/config.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = filter_var($_POST['adresse'], FILTER_SANITIZE_EMAIL);
    $tel = htmlspecialchars($_POST['telephone']);
    $mdp = password_hash($_POST['motdepasse'], PASSWORD_BCRYPT);
    $adresse = htmlspecialchars($_POST['adresse-livraison']);
    $info = htmlspecialchars($_POST['infos-supplementaires']);
    $codepostal = htmlspecialchars($_POST['code-postal']);
    $ville = htmlspecialchars($_POST['ville']);

    try {
        $stmt = $pdo->prepare("INSERT INTO client(nom, prenom, mail, tel, mdp, adresse, info, codepostal, ville) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $mail, $tel, $mdp, $adresse, $info, $codepostal, $ville]);

        header("Location: Connexion.php?message=success");
        exit();
    } catch (Exception $e) {
        header("Location: Connexion.php?message=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/formulaire.css">
  <title>Créer ton compte</title>
  <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
</head>
<body>

<header>
  <?php require '../../squelette/header.php'; ?>
</header>

<main>
  <div class="container">
    <!-- Colonne de gauche -->
    <div class="left-column">
      <h2>Créer ton compte</h2>

<!-- Message dynamique affiché ici -->
<?php
if (!empty($message)) {
    echo $message;
}
?>

<form class="formulaire-creation-compte" method="POST" action="">
  <div class="form-row">
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom" class="input-field" required>
    </div>
    <div class="form-group">
      <label for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" class="input-field" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="adresse">Adresse mail</label>
      <input type="email" id="adresse" name="adresse" class="input-field" required>
    </div>
    <div class="form-group">
      <label for="telephone">Téléphone</label>
      <input type="text" id="telephone" name="telephone" class="input-field" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="motdepasse">Mot de passe</label>
      <input type="password" id="motdepasse" name="motdepasse" class="input-field" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="adresse-livraison">Adresse de livraison</label>
      <input type="text" id="adresse-livraison" name="adresse-livraison" class="input-field">
    </div>
    <div class="form-group">
      <label for="infos-supplementaires">Informations supplémentaires</label>
      <input type="text" id="infos-supplementaires" name="infos-supplementaires" class="input-field">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="code-postal">Code postal</label>
      <input type="text" id="code-postal" name="code-postal" class="input-field" required>
    </div>
    <div class="form-group">
      <label for="ville">Ville</label>
      <input type="text" id="ville" name="ville" class="input-field" required>
    </div>
  </div>
  <div class="footer">
    <p>Tu as déjà un compte ? <span><a href="Connexion.php" class="link-connect">Connecte-toi</a></span></p>
    <div class="buttons">
      <button type="submit" class="btn-valider">Valider</button>
    </div>
  </div>
</form>
</div>
<div class="right-column">
<section class="main-display">
  <img src="../../medias/meknes.png" alt="Armoire">
</section>
</div>
</div>
</main>
<?php require_once '../../squelette/footer.php'?>
</body>



</html>
