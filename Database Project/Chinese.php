<?php 
// Start the session
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : '';


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Arab Cuisine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="origin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <a href="index.html" class="logo">
            <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165" />
        </a>
        <label class="logo"></label>
        <ul>
            <li><a href='index.php'>Home</a></li>
            <li><a href='cuisine.php'>Cuisines</a></li>
            <li><a href='recipes.php'>Recipes</a></li>
            <?php if ($is_logged_in): ?>
                <!-- Display the personalized greeting -->
                <li><a href ="account.php">ACCOUNT</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <li> HELLO, <?php echo htmlspecialchars(strtoupper($user_name));?></li>
            <?php else: ?>
                <li><a href="login.php">LOGIN</a></li>
            <?php endif; ?>
        </ul>

        <br>
        <!-- Place this within your <nav> or appropriate section -->
        <div class="recipe-links-container">

        <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "recipe";

        // Create connection
        $conn = new mysqli($host, $user, $pass, $dbname);

        // Display cuisine title, origin, and description
        $sql = "SELECT name, origin, description FROM cuisine WHERE cuisine_id = 204";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = isset($row['name']) ? $row['name'] : '';
                $origin = isset($row['origin']) ? $row['origin'] : '';
                $description = isset($row['description']) ? $row['description'] : '';

                echo "<div class='title-container'><h2>$name</h2></div><br>";
                echo "<div class='origin-container'>Origin : $origin</div><br>";
                echo "<div class='description-container'>$description</div><br>";
            }
        }

        // Display recipe titles and images
        $sql = "SELECT r.title FROM recipes r
                JOIN cuisine c ON r.cuisine_id = c.cuisine_id
                WHERE c.cuisine_id = 204";
        $result = $conn->query($sql);

        while ($valid = $result->fetch_assoc()) {
            $title = isset($valid['title']) ? $valid['title'] : '';
            $link = str_replace(' ', '_', $title) . '.php';
            echo "<h3><a href='$link'>$title</a></h3><br>";
            $imagePath = str_replace(' ', ' ', $title) . ".jpg";
            echo "<div class='cusine-container'>";
            echo "<img src='./Recipes/$imagePath' alt='$title' style='width: 100%; height: auto;'>";
            echo "</div>";
        }
        ?>
        <!-- footer --> 
        <div class="footer"?>
            <p>
                &copy;
                <span class="footer-logo">RecipesAroundTheWorld</span>
            </p>
        </div>
    </nav>
</body>

</html>
