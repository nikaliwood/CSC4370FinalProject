<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";
$conn = new mysqli($host, $user, $pass, $dbname);

// Get data from POST request
$user_id = (int) $_POST['user_id'];
$recipe_id = (int) $_POST['recipe_id'];

// Delete the like
$sql = "DELETE FROM likes WHERE user_id = ? AND recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $recipe_id); // Correct parameter binding
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Successfully removed like."; // Response on success
} else {
    echo "Could not remove like or it did not exist."; // Response if nothing is removed
}

$stmt->close();
$conn->close();
?>
