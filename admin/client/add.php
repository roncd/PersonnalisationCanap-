<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajoute un client</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Ajoute un client</h2>
            <div class="form">
                <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="Lastname">Nom</label>
                        <input type="name" id="LastName"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="FirstName">Prénom</label>
                        <input type="name" id="FirstName"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="email">Mail</label>
                        <input type="email" id="email"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" id="mdp"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="info">Info suplémentaire</label>
                        <input type="text" id="info"  class="input-field">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="codepostal">Code postal</label>
                        <input type="codepostal" id="codepostal"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="ville" id="ville"  class="input-field" require>
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
                    <button class="btn-valider">Valider</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>