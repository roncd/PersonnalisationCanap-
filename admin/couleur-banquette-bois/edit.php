<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifie une couleur de banquette en bois</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Modifie une couleur de banquette en bois</h2>
            <div class="form">
                <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="price">Prix (en €)</label>
                        <input type="number" id="price"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="img">Image</label>
                        <input type="text" id="img" class="input-field" require>
                    </div>
                    </div>
                </form>
                <div class="footer">
                    <div class="buttons">
                    <button class="btn-retour" onclick="history.go(-1)">Retour</button>
                    <button class="btn-valider">Valider</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>