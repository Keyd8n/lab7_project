<?php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

$id = intval($_GET['id']);

// Збільшити кількість переглядів
$conn->query("UPDATE materials SET views = views + 1 WHERE id = $id");

// Отримати дані матеріалу
$result = $conn->query("
    SELECT materials.title, materials.content, authors.name AS author, categories.name AS category, views
    FROM materials
    JOIN authors ON materials.author_id = authors.id
    JOIN categories ON materials.category_id = categories.id
    WHERE materials.id = $id
");

$material = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($material['title']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1><?= htmlspecialchars($material['title']) ?></h1>
    <nav>
        <a href="index.html">🏠 Головна</a>
    </nav>
    <p><strong>Автор:</strong> <?= $material['author'] ?> | <strong>Категорія:</strong> <?= $material['category'] ?> | <strong>Перегляди:</strong> <?= $material['views'] ?></p>
    <div style="white-space: pre-wrap; background: #f9f9f9; padding: 15px; border-radius: 6px;">
        <?= nl2br(htmlspecialchars($material['content'])) ?>
    </div>
</div>
</body>
</html>
