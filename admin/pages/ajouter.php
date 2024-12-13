<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une donnée</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/bdd.css">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>

    <main>
        <div class="container">
            <!-- Colonne de gauche -->
            <h2>Ajoute une donnée</h2>
            <div class="tableau">
                <div class="button-grid-container">
                    <a class="custom-button" href="../client/add.php">Ajoute un Client</a>
                    <a class="custom-button" href="../commande/add.php">Ajoute une Commande</a>
                    <a class="custom-button" href="../commande-detail/add.php">Ajoute une Commande détaillé</a>
                    
                    <a class="custom-button" href="../structure/add.php">Ajoute une Structure</a>
                    <a class="custom-button" href="../dimension/add.php">Ajoute une Dimension</a>
                    <a class="custom-button" href="../banquette/add.php">Ajoute un Type banquette</a>
                   
                    <a class="custom-button" href="../mousse/add.php">Ajoute un Type mousse</a>
                    <a class="custom-button" href="../nb-accoudoirs/add.php">Ajoute un Nombre d'accoudoir</a>
                    <a class="custom-button" href="../relation-tissu-motif/add.php">Ajoute une Compatibilité tissu/motif</a>
                </div>

                <div class="button-grid-container">
                    <a class="custom-button" href="../couleur-banquette-bois/add.php">Ajoute une Couleur bois</a>
                    <a class="custom-button" href="../decoration/add.php">Ajoute une Décoration bois</a>
                    <a class="custom-button" href="../accoudoirs-bois/add.php">Ajoute un Accoudoir bois</a>
              
                    <a class="custom-button" href="../dossier-bois/add.php">Ajoute un Dossier bois</a>
                    <a class="custom-button" href="../couleur-tissu-bois/add.php">Ajoute une Couleur tissu bois</a>
                    <a class="custom-button" href="../motif-bois/add.php">Ajoute un Motif coussins bois</a>
                </div>

                <div class="button-grid-container">
                    <a class="custom-button" href="../modele-banquette-tissu/add.php">Ajoute un Modèle banquette</a>
                    <a class="custom-button" href="../couleur-tissu-tissu/add.php">Ajoute une Couleur tissu</a>
                    <a class="custom-button"href="../motif-tissu/add.php">Ajoute un Motif coussin tissu</a>
              
                    <a class="custom-button" href="../dossier-tissu/add.php">Ajoute un Dossier tissu</a>
                    <a class="custom-button" href="../accoudoirs-tissu/add.php">Ajoute un Accoudoir tissu</a>
                </div>
            </div>         
        </div>
        </div>
        
    </main>
</body>
</html>

