<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Page</title>
    <link rel="stylesheet" href="./css/stylesTwo.css">
</head>
<body>
    <header>
        <div class="header-content">
            <a href="./index.php" style="text-decoration: none; color: inherit;"><h1>Cook<br>With<br>Me</h1></a>
            <img class="headimg" src="./content/AdobeStock_235582346.jpeg" alt="image of vegetables being sauteed in a pan">
        </div>
        <div class="menu">
            <a class="button" href="./abouttwo.html">About</a>
            <a class="button" href="./all-recipestwo.php">All Recipes</a>
        </div>
    </header>

    <!--PHP Set up Start-->
        <?php
        include 'includes/db-connection.php';

            $recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($recipe_id > 0) {

                $sql_query = "SELECT * FROM recipes WHERE id = $recipe_id";
                $result = mysqli_query($connection, $sql_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $recipe = mysqli_fetch_assoc($result);

            ?>
    <!--PHP End-->

        <div class="recipe-container">
            <!--Side bar-->
            <div class="ingredients">
                <h3>Ingredients</h3>
                <ul>
                    <?php 
                        $ingredients = preg_split("/\r\n|\n|\r/", $recipe["ingredients"]);
                        foreach ($ingredients as $ingredient): 
                        ?>
                            <li><?php echo $ingredient; ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Cook Time: <?php echo ($recipe ["cooktime"])?>Min | <?php echo ($recipe ["servings"])?> Servings</p>
            </div>

                <?php
                $step_images = explode("*", $recipe ["stepimg"]);
                $steps_array = explode("*", $recipe ["steps"]);
                ?>

            <!--Recipe Start Info-->
            <div class="recipe-heading">
                <h2><?php echo ($recipe ["title"])?></h2>
                    <h3><?php echo ($recipe ["subtitle"])?></h3>
                        <img alt="Main Image" class="recipe-head-img" src="<?php echo ($recipe ["mainimg"])?>.webp">
                        <p class="description-text"><?php echo ($recipe ["description"])?></p>
                        <div class="recipe-seperator"></div>
            </div>

            <!--Recipe Steps-->
                <?php 
                    foreach ($steps_array as $index => $step){
                        $step_parts = explode ("--", $step);
                        $step_title = isset($step_parts[0]) ? trim($step_parts [0]) : '';
                        $step_description = isset($step_parts[1]) ? trim($step_parts[1]) : '';
                        $step_image = isset($step_images[$index]) && !empty($step_images[$index])  ? trim($step_images [$index]): $recipe["mainimg"];
                ?>
                    <img alt="Images of steps" class="step-img step<?php echo $index + 1; ?>" src="<?php echo ($step_image);?>.webp" >
                    <div class="step-text step<?php echo $index + 1; ?>">
                        <h3><?php echo ($step_title);?></h3>
                        <p><?php echo ($step_description);?></p>    
                    </div>
                <?php
                }
                ?>
        </div>
            <?php 
               } else{ ?> 
                <h2 class="invalid-message"> Recipe Not Found</h2>
            <?php   }
                } else { ?>
                    <h2 class="invalid-message"> Invalid Recipe ID</h2>
            <?php } ?>
    <footer></footer>
</body>
</html>