<?php 
// Start session and ensure connection to the database
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";
$conn = new mysqli($host, $user, $pass, $dbname);

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$recipe_id = 10; // Use the correct recipe ID

$is_liked = false;

// Check if the user has already liked the recipe
if ($is_logged_in) {
    $sql = "SELECT * FROM likes WHERE user_id = ? AND recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $recipe_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $is_liked = true; // The user has liked this recipe
    }

    $stmt->close();
}

$conn->close();


?>
<html lang="en" dir="ltr">
    <head>  
        <meta charset="utf-8">
        <title>RecipesAroundTheWorld</title>
        <meta name="viewport" content="width=device-width, intial-scale = 1.0">
        <link rel = "stylesheet" href="recipes1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </label>
    
    </head>
    <body>
        <nav>
            <input type ="checkbox" id="check">
            <label for = "check" class="checkbtn">
                <i class="fa fa-bars"></i>
            </label>
            <a href="index.php" class="logo">
                <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165"/>
            </a>
            <label class ="logo"></label>
            <ul>
                <li><a href ='index.php'>Home</a></li>
                <li><a href ='cuisine.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                
                <?php if ($is_logged_in): ?>
                <!-- Display the personalized greeting -->
                <li><a href ="account.php">ACCOUNT</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <li> HELLO, <?php echo htmlspecialchars(strtoupper($user_name));?></li>
                
            <?php else: ?>
                <li><a href="login.php">LOGIN</a></li>
            <?php endif; ?>
            </ul>
        </nav>
    

    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "recipe";

        // Create connection
        $conn = new mysqli($host, $user, $pass, $dbname);

        $sql = "SELECT title FROM recipes
            WHERE recipe_id = 10";
            $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Access the data safely
                $title = isset($row['title']) ? $row['title'] : '';
                
                // Use $name and $measurement as needed
                echo "<br><h1><center>$title</center></h1><br><br>";
                
            }
            $imagePath = str_replace(' ', ' ', $title) . ".jpg";
            echo "<div class='image'>";
            echo "<center><img src='./Recipes/$imagePath' alt='$title' style='width: 50%'></center>";
            echo "</div>";
        }
        ?>
        <!-- Heart Button -->
          <!-- Assuming you're passing recipe_id as a GET parameter to the page -->
          <button id="likeButton" onclick="toggleLike()">
                <!-- Set initial color based on $is_liked -->
                <i class="fa fa-heart" style="color: <?php echo $is_liked ? 'red' : 'gray'; ?>;"></i>
          </button>

        <script>
            function toggleLike() {
    const button = document.getElementById("likeButton");
    const heartIcon = button.querySelector("i");
    const recipeId = 10; // Correct recipe ID
    const userId = <?php echo $user_id; ?>; // Current user ID

    const isRed = heartIcon.style.color === "red"; // Check current color

    if (isRed) {
        // If red, change to gray and remove like
        heartIcon.style.color = "gray";
        removeLike(userId, recipeId);
    } else {
        // If gray, change to red and save like
        heartIcon.style.color = "red";
        saveLike(userId, recipeId);
    }
}


            function saveLike(userId, recipeId) {
                fetch("save_like.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `user_id=${userId}&recipe_id=${recipeId}`,
                })
                .then((response) => response.text())
                .then((data) => {
                    console.log(data); // Debug output
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
            }

            function removeLike(userId, recipeId) {
                fetch("remove_like.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `user_id=${userId}&recipe_id=${recipeId}`,
                })
                .then((response) => response.text())
                .then((data) => {
                    console.log(data); // Debug output
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
            }

        </script>


        <?php
        $sql = "SELECT description FROM recipes WHERE recipe_id = 10";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                // Output data
                $row = $result->fetch_assoc();
                $description = isset($row['description']) ? $row['description'] : '';
                echo "<div class='description'>";
                echo "<br><center>$description</center><br>";
            }
            
            echo "<div class='content-container'>";
            echo "<div class='ingredients-container'>";
            echo "<center><h4>Ingredients</h4></center><br>";
            $sql = "SELECT name, measurement FROM ingredient WHERE recipe_id = 10";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = isset($row['name']) ? $row['name'] : '';
                    $measurement = isset($row['measurement']) ? $row['measurement'] : '';
                    echo "<center><p>$measurement - $name</p></center>";
                }
            }
            echo "</div>";

            // Instructions
            echo "<div class='instructions-container'>";
            echo "<h4>Instructions</h4><br>";
            $sql = "SELECT instructions FROM recipes WHERE recipe_id = 10";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($valid = $result->fetch_assoc()) {
                    echo "<p>{$valid['instructions']}</p><br>";
                }
            }
            echo "</div>";
            echo "</div>";

        
        $conn->close();
    ?>
    <!-- footer -->
    <div class="footer"?>
            <p>
                &copy;
                <span class="footer-logo">RecipesAroundTheWorld</span>
            </p>
    </div>
</body>
</html>