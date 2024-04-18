<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soy Sauce Pan Fried Noodles</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon" />
    <!-- normalize -->
    <link rel="stylesheet" href="./css/normalize.css" />
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <!-- main css -->
    <link rel="stylesheet" href="recipes.css" />
  </head>
  <body>
  <nav class="navbar">
      <div class="nav-center">
        <div class="nav-header">
          <a href="index.html" class="nav-logo">
            <img src="./assets/logo.jpg" alt="simply recipes" />
          </a>
          <button class="nav-btn btn">
            <i class="fas fa-align-justify"></i>
          </button>
        </div>
        <div class="nav-links">
          <a href="index.html" class="nav-link"> home </a>
          <a href="about.html" class="nav-link"> about </a>
          <a href="tags.html" class="nav-link"> tags </a>
          <a href="recipes.html" class="nav-link"> recipes </a>

          <div class="nav-link contact-link">
            <a href="contact.html" class="btn"> Login </a>
          </div>
        </div>
      </div>
    </nav>
    <h1><center>Soy Sauce Pan Fried Noodles</center></h1>
    <main class="page">
      <div class="recipe-page">
      <article class="recipe-info">
            <p><center>
              <?php
                $host = "localhost";
                $user = "root";
                $pass = "";
                $dbname = "recipe";

                // Create connection
                $conn = new mysqli($host, $user, $pass, $dbname);
                  $sql = "SELECT description FROM recipes WHERE recipe_id = 1";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        // Output data
                        $row = $result->fetch_assoc();
                        $description = isset($row['description']) ? $row['description'] : '';
                        echo $description;
                    } else {
                        echo "Description not found";
                    }
                ?></center>
            </p>
          </article>  
      <section class="recipe-hero">
          <center></cnter><img
            src="./assets/recipes/PanFriedNoodles.jpg"
            width="400"
          /></center>
        </section>
        <!-- content -->
        <section class="recipe-content">
          <article class="steps">
            <div>
              <h4>Ingredients</h4>
              <?php
                $sql = "SELECT name, measurement FROM ingredient
                WHERE recipe_id = 1";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Access the data safely
                        $name = isset($row['name']) ? $row['name'] : '';
                        $measurement = isset($row['measurement']) ? $row['measurement'] : '';
                        
                        // Use $name and $measurement as needed
                        echo "$name - $measurement<br>";
                    }

                }
                else {
                    echo "yes";
                }
                ?>
            </div>
          </article>
          <article>
            <h4>Instructions</h4>
            <article class="steps">
                <?php
                  $sql = "SELECT instructions FROM recipes
                  WHERE recipe_id = 1";
                  $result = $conn->query($sql);
  
                  while ($valid = $result->fetch_assoc()) {
                      echo '<p><div class="instructions">' . $valid['instructions'] . '</div></p>';
                  }
  
                  $conn->close();
                ?>
          </article>
        </section>
      </div>
    </main>
    <!-- footer -->
    <footer class="page-footer">
      <p>
        &copy;
        <span class="footer-logo">RecipesAroundTheWorld</span>
      </p>
    </footer>
    <script src="./js/app.js"></script>
  </body>
</html>
