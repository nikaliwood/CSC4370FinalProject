<?php
session_start(); // Start the session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; 
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; 

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RecipesAroundTheWorld</title>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"><i class="fa fa-bars"></i></label>
        <a href="index.php" class="logo">
            <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165"/>
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cuisine.php">Cuisines</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="review.php">Review</a></li>
            <?php if ($is_logged_in): ?>
            <!-- Display the personalized greeting -->
            <li><a class = "active" href="account.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li>HELLO, <?php echo htmlspecialchars(strtoupper($user_name)); ?></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <br><br><center><h1>Account Details</h1></center>
    <br><br><br>
<?php
    // Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $selected_cuisine = $_POST['cuisine'];

    // Prepare an SQL statement to update the cuisine_type column
    $stmt = $conn->prepare("UPDATE user SET cuisine_type = ? WHERE user_id = ?");
    $stmt->bind_param('si', $selected_cuisine, $user_id); // 'si' represents string and integer
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Cuisine preference updated successfully.<br>";
    } else {
        echo "Failed to update cuisine preference.<br>";
    }

    $stmt->close(); // Close the statement
}

echo "</center><div class = 'words'>";
// Fetch user's current cuisine preference
if ($is_logged_in) {
    $stmt = $conn->prepare("SELECT cuisine_type FROM user WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $cuisine_type = $user_data['cuisine_type'];
        
        if (is_null($cuisine_type)) {
            echo "<br><b>Choose a favorite cuisine to get recommendations!</b></br>";
        } else {
            echo "Here are some recommended recipes based on your favorite cuisine: <a href = " . htmlspecialchars($cuisine_type) .".php> Click here!</a>";
            // Add code to display recommendations based on cuisine_type
        }
    }
}

?>
 

    <p>Name: <?php echo htmlspecialchars($user_name); ?></p>
    <p>Account Number: <?php echo htmlspecialchars($user_id); ?></p>

    <form method="post" action="account.php">
        <label for="cuisine_type">Select Your Favorite Cuisine</label>
        <select id="cuisine_type" name="cuisine">
            <option value="Arab">Arab</option>
            <option value="Indian">Indian</option>
            <option value="Chinese">Chinese</option>
            <option value="Mexican">Mexican</option>
            <option value="Italian">Italian</option>
        </select>
        <button type="submit">Save</button> 
    </form>

    <?php
    

        // Query to get the recipe names that the user has liked
        $sql = "
            SELECT r.title 
            FROM likes l
            JOIN recipes r ON l.recipe_id = r.recipe_id
            WHERE l.user_id = ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            echo "<h3>Your Liked Recipes:</h3>";
            while ($row = $result->fetch_assoc()) {
                $recipe_title = htmlspecialchars($row['title']); // Sanitize the output
                
                // Create a clickable link based on the recipe title
                echo " <a href='{$recipe_title}.php'>$recipe_title</a><br>"; // Link to the corresponding PHP file
            }
        } else {
            echo "<p>No liked recipes yet.</p>"; // If the user hasn't liked any recipes
        }

        $stmt->close();
        $conn->close();
       
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div></center>
<!-- footer -->
    <div class="footer"?>
        <p>
            &copy;
            <span class="footer-logo">RecipesAroundTheWorld</span>
        </p>
    </div>
</body>
</html>
