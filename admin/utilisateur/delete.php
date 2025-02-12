<?php 
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = 'ID de l\'utilisateur manquant.';
    $_SESSION['message_type'] = 'error';
    header("Location: index.php");
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = 'L\'utilisateur a été supprimée avec succès !';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Utilisateur en tissu introuvable.';
        $_SESSION['message_type'] = 'error';
    }
} catch (Exception $e) {
    $_SESSION['message'] = 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage();
    $_SESSION['message_type'] = 'error';
}

header("Location: index.php");
exit();
?>