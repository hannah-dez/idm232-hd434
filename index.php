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
            <a href="./abouttwo.html"><button>About</button></a>
            <a href="./all-recipestwo.php"><button>All Recipes</button></a>
            <a href="#searchbar"><button>Search</button></a>
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
        <?php
        $searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';
        $searchResults = [];
        
        if ($searchQuery) {
            // Prepare the SQL query
            $sql = "SELECT * FROM recipes WHERE title LIKE ? OR description LIKE ?";
            $stmt = $connection->prepare($sql);
            $searchTerm = '%' . $searchQuery . '%';
            $stmt->bind_param("ss", $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
        
            // Fetch the results
            while ($row = $result->fetch_assoc()) {
                $searchResults[] = $row;
            }
        
            $stmt->close();
        }
        
        $connection->close();
    ?>
        <div class="search" id="searchbar">
            <h2>Search</h2>
            <form method="GET">
                <input type="text" name="query" placeholder="What would you like to make? .." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <?php 
            if ($searchQuery): ?>
            <h2 class="search-title">Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
                
                    <?php if (count($searchResults) > 0): ?>
                        <div class="recipe-card-search">
                            <?php foreach ($searchResults as $recipe): 
                                $short_description = strlen($recipe["description"]) > 200 ? substr($recipe["description"], 0, 200) . "..." : $recipe["description"];
                                ?>
                                <a href="individualrecipe.php?id=<?php echo ($recipe["id"]); ?>">
                                    <div class="recipe-card-small">
                                        <img src="<?php echo ($recipe["mainimg"]); ?>.webp" alt="Recipe Image">
                                        <h3 class="recipe-title"><?php echo ($recipe["title"]); ?></h3>
                                        <p><?php echo ($recipe["servings"]); ?> Servings</p>
                                        <p><?php echo ($recipe["cooktime"]); ?> Min</p>
                                        <p><?php echo ($recipe["categories"]); ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No results found for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                    <?php endif; ?>
                <?php endif; ?>
                

    </main>
    <footer></footer>
</body>
</html>