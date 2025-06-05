<?php
// api/materials.php
$conn = new mysqli("localhost", "root", "", "learning_materials_db");

$materials = $conn->query("
    SELECT materials.id, materials.title, authors.name AS author, categories.name AS category, views
    FROM materials
    JOIN authors ON materials.author_id = authors.id
    JOIN categories ON materials.category_id = categories.id
    ORDER BY materials.id DESC
    LIMIT 10
");

$data = [];
while ($row = $materials->fetch_assoc()) {
    $data[] = $row;
}

header("Content-Type: application/json");
echo json_encode($data);
