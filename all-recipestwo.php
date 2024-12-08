<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Recipes</title>
    <link rel="stylesheet" href="./css/stylesTwo.css">
</head>
<body>
<?php
    // Include the database connection
    include 'includes/db-connection.php';

    // Query to fetch the first row
    $sql = "SELECT * FROM recipes";
    $result = $connection->query($sql);
    
    $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
    $filtered_recipes = [];
    $all_recipes = [];

    if ($result && mysqli_num_rows($result)>0) //if you have results more than zero it shows
    {
        while($row = mysqli_fetch_assoc($result)){
           $matches_search = !$search_query || (
                stripos($row ['title'], $search_query) !== false ||
                stripos($row ['subtitle'], $search_query) !== false ||
                stripos($row ['description'], $search_query) !== false ||
                stripos($row ['cooktime'], $search_query) !== false
           );
           if (empty($search_query)){
             $all_recipes[] = $row;
           }
            else if($matches_search) {
                $filtered_recipes [] =$row;
            }
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
            <form   action="all-recipestwo.php" method="get">
                <input type="text" class="search-input search" name="search" placeholder="Search...">
                <button class="submit-button" type="submit">SEARCH</button>
            </form>
        </div>
        </div>
    </header>
    <main>
        <div class="container">
       <!-- Sidebar -->
       <aside class="sidebar">
           <h2>Filter Options</h2>
           <div class="filter">
               <label for="cuisine">Cuisine:</label>
               <select id="cuisine">
                   <option value="all">Cuisine</option>
                   <option value="italian">Italian</option>
                   <option value="mexican">Mexican</option>
                   <option value="asian">Asian</option>
               </select>
           </div>
           <div class="filter">
               <label for="cook-time">Cook Time:</label>
               <select id="cook-time">
                   <option value="all">Cook-Time</option>
                   <option value="less-than-30">Less than 30 min</option>
                   <option value="30-60">30 - 60 min</option>
                   <option value="more-than-60">More than 60 min</option>
               </select>
           </div>
           <div class="filter">
               <label for="serving-size">Serving Size:</label>
               <select id="serving-size">
                   <option value="all">Serving-Size</option>
                   <option value="small">1-2</option>
                   <option value="medium">3-4</option>
                   <option value="large">5+</option>
               </select>
           </div>
       </aside>
       <div class="allrecipe-grid">
        <?php
            if (!empty($filtered_recipes)){
                foreach($filtered_recipes as $recipe){ ?>
                <a href="individualrecipe.php?id=<?php echo ($recipe ["id"])?>">
            <div class="recipe-card-small recipe-search-result">
                <img src="<?php echo ($recipe["mainimg"])?>.webp">
                <h3 class="recipe-title"><?php echo ($recipe ["title"])?></h3>
                <p><?php echo ($recipe ["servings"])?> Servings</p>
                <p><?php echo ($recipe ["cooktime"])?> Min</p>
                <p><?php echo ($recipe ["categories"])?></p>
            </div>
        </a>
        <?php } } 
                else if (!empty($search_query) && empty($filtered_recipes)) { 
                    ?>
                    <h2>No Recipe Found</h2>
                    <?php
                } else {
                foreach($all_recipes as $recipe){ ?>
                    <a href="individualrecipe.php?id=<?php echo ($recipe ["id"])?>">
                        <div class="recipe-card-small">
                            <img src="<?php echo ($recipe["mainimg"])?>.webp">
                            <h3 class="recipe-title"><?php echo ($recipe ["title"])?></h3>
                            <p><?php echo ($recipe ["servings"])?> Servings</p>
                            <p><?php echo ($recipe ["cooktime"])?> Min</p>
                            <p><?php echo ($recipe ["categories"])?></p>
                        </div>
                    </a>
                   <?php } 
        } ?>

       
       </div> 
    </div>
   </main>
    <footer></footer>
</body>
</html>
