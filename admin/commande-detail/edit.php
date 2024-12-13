<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifie une commande détaillée</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Modifie une commande détaillée</h2>
            <div class="form">
                <form class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="commande">ID Commande</label>
                        <input type="number" id="commande"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="client">ID Client</label>
                    <input type="number" id="client"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dimmension">ID Dimmension</label>
                    <input type="number" id="dimmension"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="banquette">ID Type banquette</label>
                    <input type="number" id="banquette"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="mousse">ID Mousse</label>
                    <input type="number" id="mousse"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="nbAccoudoir">ID Nombre d'accoudoir</label>
                    <input type="number" id="nbAccoudoir"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="relation">ID Relation tissu/motif</label>
                    <input type="number" id="relation"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurBois">ID couleur bois</label>
                    <input type="number" id="couleurBois"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="decoration">ID Décoration bois</label>
                    <input type="number" id="decoration"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirBois">ID Accoudoir bois</label>
                    <input type="number" id="accoudoirBois"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossierBois">ID Dossier bois</label>
                    <input type="number" id="dossierBois"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motifBois">ID Motif bois</label>
                    <input type="number" id="motifBois"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="modele">ID Modèle banquette tissu</label>
                    <input type="number" id="modele"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="couleurTissu">ID Couleur tissu</label>
                    <input type="number" id="couleurTissu"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="motifTissu">ID Motif tissu</label>
                    <input type="number" id="motifTissu"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="dossierTissu">ID Dossier tissu</label>
                    <input type="number" id="dossierTissu"  class="input-field" require>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                    <label for="accoudoirTissu">ID Accoudoir tissu</label>
                    <input type="number" id="accoudoirTissu"  class="input-field" require>
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