<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>
    <main class="connexion">
        <div class="container">
            <h2>Connexion</h2>
            <div class="form">
                <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="mail">Adresse mail</label>
                        <input type="email" id="mail"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" id="mdp"  class="input-field" require>
                    </div>
                    </div>
                    <div class="footer">
                        <p>Revenir sur <span><a href="../../front/pages/index.php" class="link-connect">Deco du monde</a></span></p>
                    <div class="buttons">
                        <button class="btn-connexion">SE CONNECTER</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>