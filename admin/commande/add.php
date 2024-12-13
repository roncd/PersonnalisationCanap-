<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajoute une commande</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Ajoute une commande</h2>
            <div class="form">
                <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="idClient">ID Client</label>
                        <input type="number" id="idClient"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="img">Prix total (en €)</label>
                        <input type="text" id="img" class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="text">Commentaire</label>
                        <textarea id="text"  class="input-field" require></textarea>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date de création</label>
                        <input type="date" id="date" class="input-field" require>
                    </div>
                    </div>
                </form>
                <div class="footer">
                    <div class="buttons">
                    <button class="btn-retour" onclick="history.go(-1)">Retour</button>
                    <input type="submit" class="btn-valider" value="Valider"></input>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>