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
            <li><a class="active" href='index.html'>Home</a></li>
            <li><a href='cuisines.php'>Cuisines</a></li>
            <li><a href='recipes.php'>Recipes</a></li>
            <li><a href='#'>Review</a></li>
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

        $sql = "SELECT name FROM cuisine WHERE cuisine_id = 203";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Access the data safely
                $name = isset($row['name']) ? $row['name'] : '';

                // Use $name and $measurement as needed
                echo "<div class='title-container'><h2>$name</h2></div><br>";
            }
        }

        $sql = "SELECT origin FROM cuisine WHERE cuisine_id = 203";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Access the data safely
                $origin = isset($row['origin']) ? $row['origin'] : '';

                // Use $name and $measurement as needed
                echo "<div class='origin-container'>Origin : $origin</div><br>";
            }
        }
        $sql = "SELECT description FROM cuisine WHERE cuisine_id = 203";
        $result = $conn->query($sql);

        while ($valid = $result->fetch_assoc()) {
            $description = isset($valid['description']) ? $valid['description'] : '';
            echo "<div class='description-container'>$description</div><br>";
        }

        $sql = "SELECT r.title from recipes r
                Join cuisine c on r.cuisine_id = c.cuisine_id
                Where c.cuisine_id = 203";
                $result = $conn->query($sql);
                while ($valid = $result->fetch_assoc()) {
                    $title = isset($valid['title']) ? $valid['title'] : '';
                    //$imagePath = isset($valid['image_path']) ? $valid['image_path'] : '';
                    $link = str_replace(' ', '_', $title) . '.php';
                    echo "<a href='$link'>$title</a> <br>";
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
