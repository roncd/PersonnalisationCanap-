<?php
require '../config.php'; // Inclure votre fichier de configuration

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Vérifier si l'ID est présent
if (isset($data['id'])) {
    $commandId = $data['id'];

    // Préparer et exécuter la requête pour supprimer la commande
    $stmt = $pdo->prepare("DELETE FROM commande_detail WHERE id = :id");
    $stmt->bindParam(':id', $commandId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Succès
        echo json_encode(['success' => true]);
    } else {
        // Échec
        echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression.']);
    }
} else {
    // Pas d'ID envoyé
    echo json_encode(['success' => false, 'error' => 'Aucun ID reçu.']);
}
?>
