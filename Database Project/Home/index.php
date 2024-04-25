<?php 
// Start the session
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; 


?>
<html lang="en" dir="ltr">
    <head>  
        <meta charset="utf-8">
        <title>RecipesAroundTheWorld</title>
        <meta name="viewport" content="width=device-width, intial-scale = 1.0">
        <link rel = "stylesheet" href="style.css">
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
                <li><a class="active" href ='index.php'>Home</a></li>
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
        <!-- picture header starts -->
        <div class="homeimg">
            <img src="homepage.jpg" class="homeimg" width="100%">
        </div>
        <div class="underimg">
            <center><h2>About</h2></center><br>
            <center><p>
                At RecipesAroundTheWorld, we believe that food has the power to transcend borders and bring people together. Our curated collection of recipes not only showcases the incredible diversity of flavors and ingredients but also honors the culinary traditions passed down through generations. Whether you're craving the comforting warmth of a hearty Italian risotto, the aromatic spices of an authentic Indian curry, the vibrant street food of Mexico, the intricate flavors of Middle Eastern mezze, or the nuanced balance of sweet and savory in Chinese cuisine, you'll find something to tantalize your taste buds and ignite your culinary creativity. With step-by-step instructions, helpful tips, and background information on each dish's cultural significance, RecipesAroundTheWorld invites you to embark on a culinary expedition without ever leaving your kitchen. So, gather your ingredients, unleash your inner chef, and let the flavors of the world inspire your next culinary masterpiece. Join us as we celebrate the universal language of food and discover the deliciousness that unites us all.
            </p><br><br></center>
        </div>
        <!-- footer -->
        <div class="footer"?>
            <p>
                &copy;
                <span class="footer-logo">RecipesAroundTheWorld</span>
            </p>
        </div>
    </head>
    </body>
</html>
