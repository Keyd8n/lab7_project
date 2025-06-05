<?php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати категорію</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>📂 Додати нову категорію</h1>
    <nav>
        <a href="index.html">🏠 Головна</a>
        <a href="add_author.php">👤 Додати автора</a>
    </nav>
    <form method="post">
        <input type="text" name="name" placeholder="Назва категорії" required>
        <button type="submit">✅ Додати категорію</button>
    </form>
</div>
</body>
</html>
