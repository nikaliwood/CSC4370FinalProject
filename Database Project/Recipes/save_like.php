<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id']; // Data from the front-end
$recipe_id = $_POST['recipe_id'];

$sql = "INSERT INTO likes (user_id, recipe_id) VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $recipe_id);

if ($stmt->execute()) {
    echo "Like saved.";
} else {
    echo "Error saving like.";
}

$stmt->close();
$conn->close();
?>
