<?php 
session_start();

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbusername = $_POST['username'];
    $dbpassword = md5($_POST['password']);

    // SQL query to validate user login
    $sql = "SELECT * FROM user WHERE username = '".$dbusername."' AND password = '".$dbpassword."'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        // Login failed, set error message
        $error_message = "Invalid Login!";
    } else {
        // Login successful, set session variables
        $user_data = $result->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $user_data['name'];

        // Redirect to home page
        header("Location: index.php");
        exit(); // Always exit after redirection
    }
}
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
            <a href="index.html" class="logo">
                <img src="./logo.jpg" alt="RecipesAroundTheWorld" width="165"/>
            </a>
            <label class ="logo"></label>
            <ul>
                <li><a href ='index.php'>Home</a></li>
                <li><a href ='cuisine.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                <li><a href ='review.php'>Review</a></li>
                <li><a class ="active" href="login.php">Login</a></li>
            </ul>
        </nav>

    <center><h2>User Login</h2></center><br><br><br>
    <form method="post" action="login.php"> <!-- Added form attributes -->
        <div class="container">
            <label for="username"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="username" required><br>
            <label for="password"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required><br>
            <button type="submit">Login</button><br><br>
        </div>
    </form>

    <p>Don't have an account? <a href="signup.php">Sign Up Here!</a></p>
    
    <!-- Display error message if any -->
    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>
