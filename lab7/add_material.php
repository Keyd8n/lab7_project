<?php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author_id = $_POST["author"];
    $category_id = $_POST["category"];

    $stmt = $conn->prepare("INSERT INTO materials (title, content, author_id, category_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $title, $content, $author_id, $category_id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$authors = $conn->query("SELECT * FROM authors");
$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати матеріал</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>➕ Додати новий навчальний матеріал</h1>
    <nav>
        <a href="index.html">🏠 Головна</a>
        <a href="popular_categories.php">📊 Популярні категорії</a>
    </nav>
    <form method="post">
        <input type="text" name="title" placeholder="Назва матеріалу" required>
        <textarea name="content" placeholder="Зміст матеріалу" rows="5"></textarea>
        <select name="author" required>
            <option value="">👤 Виберіть автора</option>
            <?php while ($a = $authors->fetch_assoc()): ?>
                <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
            <?php endwhile; ?>
        </select>
        <select name="category" required>
            <option value="">📂 Виберіть категорію</option>
            <?php while ($c = $categories->fetch_assoc()): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">✅ Додати</button>
    </form>
</div>
</body>
</html>
