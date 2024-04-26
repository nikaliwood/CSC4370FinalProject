<?php
// Start the session
session_start();

// Database connection setup
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "recipe";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['name']) && !empty($_POST['name'])
    ) {
        // Collect and sanitize the form data
        $newName = mysqli_real_escape_string($conn, $_POST['name']);
        $newUser = mysqli_real_escape_string($conn, $_POST['username']);
        $newPass = mysqli_real_escape_string($conn, $_POST['password']);

        // Insert the new user into the database with MD5 hashed password
        $sql = "INSERT INTO user (name, username, password) 
                VALUES ('$newName', '$newUser', MD5('$newPass'))";

        if ($conn->query($sql) === TRUE) {
            // Account created successfully, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            // If insertion fails, display an error message
            echo "<h2>Error creating account: " . $conn->error . "</h2>";
        }
    } else {
        echo "<h2>Please fill out all required fields.</h2>";
    }
}
?>

<html lang="en" dir="ltr">
    <head>  
        <meta charset="utf-8">
        <title>RecipesAroundTheWorld</title>
        <meta name="viewport" content="width=device-width, intial-scale = 1.0">
        <link rel = "stylesheet" href="login.css">
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
                <li><a class="active" href ='#'>Home</a></li>
                <li><a href ='cuisine.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        <center><h1><br>Sign Up!</h1></center><br><br><br>
        <div class="center-container">
            <form action="signup.php" method="post" class="form-container"> <!-- Corrected form action -->
                <label for="name">Enter Your Full Name</label><br>
                <input type="text" id="name" name="name"><br><br>
                <label for="username">Create a Username</label><br>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Create a Password</label><br>
                <input type="password" id="password" name="password"><br>
                <input type="checkbox" onclick="myFunction()"> Show Password<br><br>
                <button type="submit" name="submit" value="submit">Sign Up</button>
            </form>
        </div>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <div class="footer"?>
        <p>
            &copy;
            <span class="footer-logo">RecipesAroundTheWorld</span>
        </p>
    </div>
</body>
</html>
