<?php
require '../../admin/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulaire/Connexion.php");
    exit;
}

// Récupérer les structures disponibles depuis la base de données
$stmt = $pdo->query("SELECT * FROM structure");
$structures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
require '../../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rediriger vers l'étape suivante
    header("Location: etape1-2-dimension.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../styles/processus.css">
  <link rel="stylesheet" href="../../styles/popup.css">

  <title>Étape 1 - Choisi ta structure</title>

  <style>
    .transition {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .transition.show {
      opacity: 1;
      transform: translateY(0);
    }

    .option img.selected {
      border: 3px solid #997765;
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
      <li><a href="etape1-1-structure.php" class="active">Structure</a></li>
      <li><a href="etape1-2-dimension.php">Dimension</a></li>
      <li><a href="etape2-type-banquette.php">Banquette</a></li>
    </ul>
  </div>
  <div class="container">
    <div class="left-column transition">
      <h2>Étape 1 - Choisi ta structure</h2>
      
      <section class="color-options">
        <?php foreach ($structures as $structure): ?>
          <div class="option transition">
            <img src="../../admin/uploads/structure/<?php echo htmlspecialchars($structure['img']); ?>" 
     alt="<?php echo htmlspecialchars($structure['nom']); ?>">
            <p><?php echo htmlspecialchars($structure['nom']); ?></p>
          </div>
        <?php endforeach; ?>
      </section>

      <div class="footer">
        <p>Total : <span>899 €</span></p>
        <div class="buttons">
        <form method="POST" action="">
          <button type="submit" class="btn-suivant transition">Suivant</button>
        </form>
        </div>
      </div>
    </div>

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

  <div id="abandonner-popup" class="popup transition">
    <div class="popup-content">
      <h2>Êtes-vous sûr de vouloir abandonner ?</h2>
      <br>
      <button class="yes-btn">Oui ...</button>
      <button class="no-btn">Non !</button>
    </div>
  </div>

  <script>
   document.addEventListener('DOMContentLoaded', () => {
  const options = document.querySelectorAll('.color-options .option img'); 
  const mainImage = document.querySelector('.main-display img'); 
  const suivantButton = document.querySelector('.btn-suivant');
  const helpPopup = document.getElementById('help-popup');
  const abandonnerPopup = document.getElementById('abandonner-popup');

  document.querySelectorAll('.transition').forEach(element => {
    element.classList.add('show'); 
  });

  options.forEach(img => {
    img.addEventListener('click', () => {
      options.forEach(opt => opt.classList.remove('selected'));
      img.classList.add('selected');
      mainImage.src = img.src; 
    });
  });

  suivantButton.addEventListener('click', () => {
    document.body.classList.remove('show');
    setTimeout(() => {
      window.location.href = 'etape1-2-dimension.php';
    }, 500);
  });

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

  document.querySelector('.btn-abandonner').addEventListener('click', () => {
    abandonnerPopup.style.display = 'flex';
  });

  document.querySelector('#abandonner-popup .yes-btn').addEventListener('click', () => {
    document.body.classList.remove('show');
    setTimeout(() => {
      window.location.href = '../pages/';
    }, 500);
  });

  document.querySelector('#abandonner-popup .no-btn').addEventListener('click', () => {
    abandonnerPopup.style.display = 'none';
  });
});
  </script>
</main>

<?php require_once '../../squelette/footer.php' ?>
</body>
</html>
