<?php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $stmt = $conn->prepare("INSERT INTO authors (name) VALUES (?)");
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
    <title>Додати автора</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>👤 Додати нового автора</h1>
    <nav>
        <a href="index.html">🏠 Головна</a>
        <a href="add_category.php">📂 Додати категорію</a>
    </nav>
    <form method="post">
        <input type="text" name="name" placeholder="Ім’я автора" required>
        <button type="submit">✅ Додати автора</button>
    </form>
</div>
</body>
</html>
