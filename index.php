<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/stylesTwo.css">
</head>
<body>
<!--PHPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP-->
    <?php
    // Include the database connection
    include 'includes/db-connection.php';

    // Query to fetch the first row
    $sql = "SELECT * FROM recipes LIMIT 3";
    $result = $connection->query($sql);
    $all_recipes = [];

    if ($result && mysqli_num_rows($result)>0) //if you have results more than zero it shows
    {
        while($row = mysqli_fetch_assoc($result)){
            $all_recipes[] = $row;
        }
    }
    ?>
    <header>
        <div class="header-content">
            <a href="./index.php" style="text-decoration: none; color: inherit;"><h1>Cook<br>With<br>Me</h1></a>
            <img class="headimg" src="./content/AdobeStock_235582346.jpeg">
        </div>
        <div class="menu">
            <a href="./aboutTwo.html"><button>About</button></a>
            <a href="./all-recipesTwo.php"><button>All Recipes</button></a>
        </div>
    </header>
    <main class="homepage">
        <h2 class="page-heading">Top Recipes</h2>
        <div class="homepage-grid">
            <?php 
            foreach($all_recipes as $recipe){ 
                $short_description = strlen($recipe["description"]) > 200 ? substr($recipe["description"], 0, 200) . "..." : $recipe["description"];
                ?>
                <a href="individualrecipe.php?id=<?php echo ($recipe ["id"])?>">
                    <div class="recipe-card">
                        
                        <img src="<?php echo ($recipe ["mainimg"])?>.webp">
                        <h3 class="recipe-title"><?php echo ($recipe ["title"]) ?></h3>
                        <p><?php echo( $short_description) ?></p>
                        <p><?php echo ($recipe ["servings"])?> Servings</p>
                        <p><?php echo ($recipe ["cooktime"])?> Min</p>
                        <p><?php echo ($recipe ["categories"])?></p>
                    </div>
                </a>
            <?php } ?>
            
            
        </div>
    </main>
    <footer></footer>
</body>
</html>