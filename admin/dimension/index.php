<?php 
require '../config.php';
session_start();

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit();
    }
$search = $_GET['search'] ?? '';

$tables = ['structure'];

function fetchData($pdo, $table) {
    $stmt = $pdo->prepare("SELECT id, nom FROM $table");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$data = [];
$assocData = [];

foreach ($tables as $table) {
    $data[$table] = fetchData($pdo, $table);
    $assocData[$table] = array_column($data[$table], 'nom', 'id');

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimension</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/tab.css">
    <link rel="icon" type="image/x-icon" href="../../medias/favicon.png">
</head>
<body>

    <header>
    <?php require '../squelette/header.php'; ?>
    </header>
    <main>
        <div class="container">
            <h2>Dimension</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message ' . htmlspecialchars($_SESSION['message_type']) . '">';
                echo htmlspecialchars($_SESSION['message']);
                echo '</div>';
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
            <div class="tab-container">
            <table class="styled-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>LONGUEUR_A</th>
                    <th>LONGUEUR_B</th>
                    <th>LONGUEUR_C</th>
                    <th>PRIX</th>
                    <th>STRUCTURE_ID</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    // Récupérer les données depuis la base de données
                    if ($search) {
                        $stmt = $pdo->prepare("SELECT * FROM dimension WHERE prix LIKE ?");
                        $stmt->execute(['%' . $search . '%']);
                    } else {
                        $stmt = $pdo->query("SELECT * FROM dimension");
                    }
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['longueurA']}</td>";
                        echo "<td>{$row['longueurB']}</td>";
                        echo "<td>{$row['longueurC']}</td>";
                        echo "<td>{$row['prix']}</td>";
                        echo "<td>" . htmlspecialchars($assocData['structure'][$row['id_structure']] ?? ' N/A') . "</td>";
                        echo "<td class='actions'>";
                        echo "<a href='edit.php?id={$row['id']}' class='edit-action actions vert' title='Modifier'>EDIT</a>";
                        echo "<a href='delete.php?id={$row['id']}' class='delete-action actions rouge' title='Supprimer' onclick='return confirm(\"Voulez-vous vraiment supprimer cette structure ?\");'>DELETE</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>
    <footer>
        <?php require '../squelette/footer.php'; ?>
    </footer>
</body>
</html>