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
                <li><a class="active" href ='#'>Home</a></li>
                <li><a href ='cuisines.php'>Cuisines</a></li>
                <li><a href ='recipes.php'>Recipes</a></li>
                <li><a href ='#'>Review</a></li>
            </ul>
            
            <br>
            
            <?php 
                $host = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "recipe";
            
                // Create connection
                $conn = new mysqli($host, $user, $pass, $dbname);

                $sql = "SELECT name FROM cuisine
                WHERE cuisine_id = 203";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Access the data safely
                        $name = isset($row['name']) ? $row['name'] : '';
                        
                        // Use $name and $measurement as needed
                        echo "<h2>$name</h2><br><br>";
                    }
            
                }

                $sql = "SELECT origin FROM cuisine
                WHERE cuisine_id = 203";
                $result = $conn->query($sql);
            
                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Access the data safely
                        $origin = isset($row['origin']) ? $row['origin'] : '';
                        
                        // Use $name and $measurement as needed
                        echo "Origin : $origin<br><br>";
                    }
            
                }
                $sql = "SELECT description FROM cuisine WHERE cuisine_id = 203";
                $result = $conn->query($sql);
                
                while ($valid = $result->fetch_assoc()) {
                    $description = isset($valid['description']) ? $valid['description'] : '';
                    echo "$description<br>";
                }
                
            ?>
        </nav>
    </body>
</html>
