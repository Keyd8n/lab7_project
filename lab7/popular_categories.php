<?php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

$sql = "
    SELECT categories.name, COUNT(materials.id) AS material_count, SUM(views) AS total_views
    FROM categories
    JOIN materials ON materials.category_id = categories.id
    GROUP BY categories.id
    ORDER BY total_views DESC
    LIMIT 5;
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Популярні категорії</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>📊 Популярні категорії</h1>
    <nav>
        <a href="index.html">🏠 Головна</a>
        <a href="add_material.php">➕ Додати матеріал</a>
    </nav>

    <ul class="material-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= $row['name'] ?></strong><br>
                Матеріалів: <?= $row['material_count'] ?> |
                Переглядів: <?= $row['total_views'] ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
