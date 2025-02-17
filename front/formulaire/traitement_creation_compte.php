<?php
// Inclure le fichier de configuration pour se connecter à la base de données
require '../../admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
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
        // Préparation et exécution de la requête
        $stmt = $pdo->prepare("INSERT INTO client(nom, prenom, mail, tel, mdp, adresse, info, codepostal, ville) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $mail, $tel, $mdp, $adresse, $info, $codepostal, $ville]);

        // Redirection après succès
        header('Location: success.php');
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la création du compte : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
