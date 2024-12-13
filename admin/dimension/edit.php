<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifie une dimension</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Modifie une dimension</h2>
            <div class="form">
            <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurA">Longueur A (en cm)</label>
                        <input type="number" id="longueurA"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurB">Longueur B (en cm)</label>
                        <input type="number" id="longueurB"  class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurC">Longueur C (en cm)</label>
                        <input type="number" id="longueurC"  class="input-field" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="price">Prix (en €)</label>
                        <input type="number" id="price"  class="input-field" require>
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