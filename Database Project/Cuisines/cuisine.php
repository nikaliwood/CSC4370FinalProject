<?php
// Start the session
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : '';

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
        <link rel = "stylesheet" href="cuisine.css">
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
                <li><a href ='index.php'>Home</a></li>
                <li><a class = "active" href ='cuisine.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                <li><a href ='review.php'>Review</a></li>
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
        <br><br><br><br>

        <?php 
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "recipe";

            // Create connection
            $conn = new mysqli($host, $user, $pass, $dbname);

            $sql = "SELECT name FROM cuisine";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = isset($row['name']) ? $row['name'] : '';
                    $imageSrc = str_replace(' ', '_', $name) . ".jpg";
                    $link = str_replace(' ', '_', $name) . '.php';
                    echo "<div style='text-align: center;'>";
                    echo "<a href='$link' style='color: black; font-family: Garamond, Serif; font-size: 25px;'>$name</a><br>";
                    echo "<img src='$imageSrc' alt='$name' style='display: block; margin: 0 auto;'><br><br>";
                    echo "</div>";
                }
            }
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
