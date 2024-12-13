<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>


    
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/commandes.css">


    
</head>
<body>

    <header>
    <?php require '../../squelette/header.php'; ?>
    </header>

    <main>
        <div class="container">
            <!-- Colonne de gauche -->
            <h2>Mes commandes</h2>
            <div class="tableau">
                <div class="tabs">
                    <button class="tab active" data-tab="validation">En attente de validation</button>
                    <button class="tab" data-tab="construction">En cours de construction</button>
                    <button class="tab" data-tab="finalisees">Commandes finalisées</button>
                </div>

                <div class="tab-content active" id="validation">
                <div class="commande">
                    <div class="info">
                    <p><strong>Nom :</strong></p>
                    <p><strong>Prénom :</strong></p>
                    <p>24/10/2024</p>
                    </div>
                    <div class="actions">
                    <img class="img" href="" src="../../medias/download.png"></img>
                    </div>
                </div>
                </div>

                <div class="tab-content" id="construction">
                <div class="commande">
                    <div class="info">
                    <p><strong>Nom :</strong></p>
                    <p><strong>Prénom :</strong></p>
                    <p>07/03/2024</p>
                    </div>
                    <div class="actions">
                    <img class="img" href="" src="../../medias/download.png"></img>
                    </div>
                </div>
                </div>
            

                <div class="tab-content" id="finalisees">
                <div class="commande">
                    <div class="info">
                    <p><strong>Nom :</strong></p>
                    <p><strong>Prénom :</strong></p>
                    <p>23/03/2024</p>
                    </div>
                    <div class="actions">
                    <img class="img" href="" src="../../medias/download.png"></img>
                    </div>
                </div>
                </div>
            </div>         
        </div>
        
</main>
<script src="../../scrpit/commandes.js"></script> 
<?php require_once '../../squelette/footer.php'?>
</body>
</html>

