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
        <title>Soy Sauce Pan Fried Noodles</title>
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
            <a href="index.html" class="logo">
                <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165"/>
            </a>
            <label class ="logo"></label>
            <ul>
                <li><a class="active" href ='index.php'>Home</a></li>
                <li><a href ='cuisine.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                <li><a href ='#'>Review</a></li>
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
            WHERE recipe_id = 1";
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
        $sql = "SELECT description FROM recipes WHERE recipe_id = 1";
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
            echo "<center><h4>Ingredients</h4></center>";
            $sql = "SELECT name, measurement FROM ingredient WHERE recipe_id = 1";
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
            echo "<h4>Instructions</h4>";
            $sql = "SELECT instructions FROM recipes WHERE recipe_id = 1";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($valid = $result->fetch_assoc()) {
                    echo "<p>{$valid['instructions']}</p>";
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
