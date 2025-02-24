<?php 
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = 'ID de la dimension manquant.';
    $_SESSION['message_type'] = 'error';
    header("Location: index.php");
    exit();
}

// Récupérer les données actuelles de la dimension
$stmt = $pdo->prepare("SELECT * FROM dimension WHERE id = ?");
$stmt->execute([$id]);
$dimension = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dimension) {
    $_SESSION['message'] = 'Dimension introuvable.';
    $_SESSION['message_type'] = 'error';
    header("Location: index.php");
    exit();
}

function fetchData($pdo, $table) {
    $stmt = $pdo->prepare("SELECT id, nom FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$structures = fetchData($pdo, 'structure');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données
    $longueurA = trim($_POST['longueurA']);
    $longueurB = trim($_POST['longueurB']);
    $longueurC = trim($_POST['longueurC']);
    $idStructure = trim($_POST['structure']);

    if (empty($longueurA) || empty($longueurB) || empty($longueurC) ||  empty($idStructure)) {
        $_SESSION['message'] = 'Tous les champs requis doivent être remplis.';
        $_SESSION['message_type'] = 'error';
    } else {
        // Mettre à jour de la dimension dans la base de données
        $stmt = $pdo->prepare("UPDATE dimension SET longueurA = ?, longueurB = ?, longueurC = ?, id_strucutre = ? WHERE id = ?");
        $stmt->execute([$longueurA, $longueurB, $longueurC, $idStructure, $id ]);

        $_SESSION['message'] = 'Dimension mise à jour avec succès!';
        $_SESSION['message_type'] = 'success';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifie une dimension</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/ajout.css">
    <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
    <style>
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Modifie une dimension</h2>
            <div class="form">
            <form action="edit.php?id=<?php echo $couleurbois['id']; ?>" method="POST" enctype="multipart/form-data" class="formulaire-creation-compte">
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurA">Longueur A (en cm)</label>
                        <input type="number" id="longueurA"  class="input-field" name="longueurA" value="<?php echo htmlspecialchars($dimension['longueurA']); ?>"required>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurB">Longueur B (en cm)</label>
                        <input type="number" id="longueurB"  class="input-field"name="longueurB" value="<?php echo htmlspecialchars($dimension['longueurB']); ?>" >
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="longueurC">Longueur C (en cm)</label>
                        <input type="number" id="longueurC"  class="input-field" name="longueurC" value="<?php echo htmlspecialchars($dimension['longueurC']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="price">Prix (en €)</label>
                        <input type="number" id="price"  class="input-field" name="prix" value="<?php echo htmlspecialchars($dimension['prix']); ?>">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="structure">Id Structure</label>
                        <select class="input-field" id="structure" name="structure">
                        <option value="">-- Sélectionnez une structure --</option>
                        <?php foreach ($structures as $structure): ?>
                            <option value="<?= htmlspecialchars($structure['id']) ?>" 
                                <?= ($structure['id'] == $dimension['id_structure']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($structure['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    </div>
                
                <div class="footer">
                    <div class="buttons">
                    <button type="button" class="btn-retour" onclick="history.go(-1)">Retour</button>
                    <input type="submit" class="btn-valider" value="Mettre à jour">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</body>
</html>