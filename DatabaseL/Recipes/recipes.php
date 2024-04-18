<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "recipe";

  // Create connection
  $conn = new mysqli($host, $user, $pass, $dbname);
?>

<html>
<html lang="en" dir="ltr">
    <head>  
        <meta charset="utf-8">
        <title>RecipesAroundTheWorld</title>
        <meta name="viewport" content="width=device-width, intial-scale = 1.0">
        <link rel = "stylesheet" href="recipes.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </label>
    
    </head>
    <body>
        <nav>
            <input type ="checkbox" id="check">
            <label for = "check" class="checkbtn">
                <i class="fa fa-bars"></i>
            </label>
            <a href="index.html" class="logo">
                <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165"/>
            </a>
            <label class ="logo"></label>
            <ul>
                <li><a class="active" href ='index.html'>Home</a></li>
                <li><a href ='cuisines.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                <li><a href ='#'>Review</a></li>
            </ul>
        </nav>

        <div class="recipe-list">
            <?php 
                $host = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "recipe";

                // Create connection
                $conn = new mysqli($host, $user, $pass, $dbname);

                $sql = "SELECT title FROM recipes";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $title = isset($row['title']) ? $row['title'] : '';
                        // Assuming each PHP file is named based on the title (e.g., Title of Recipe.php)
                        $link = str_replace(' ', '_', $title) . '.php';
                        echo "<a href='$link'>$title</a> <br>";
                    }
                }
            ?>
        </div>
        <!-- footer -->
        <div class="footer"?>
            <p>
                &copy;
                <span class="footer-logo">RecipesAroundTheWorld</span>
            </p>
        </div>
    </body>
</html>
