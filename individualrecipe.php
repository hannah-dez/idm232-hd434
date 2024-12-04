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
            <img class="headimg" src="./content/AdobeStock_235582346.jpeg">
        </div>
        <div class="menu">
            <a href="./aboutTwo.html"><button>About</button></a>
            <a href="./all-recipesTwo.html"><button>All Recipes</button></a>
        </div>
    </header>
    <?php
       include 'includes/db-connection.php';

        $recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($recipe_id > 0) {

            $sql_query = "SELECT * FROM recipes WHERE id = $recipe_id";
            $result = mysqli_query($connection, $sql_query);

            if ($result && mysqli_num_rows($result) > 0) {
                $recipe = mysqli_fetch_assoc($result);

        ?>
        <div class="recipe-container">
            <div class="ingredients">
                <h3>Ingredients</h3>
                <ul>
                    <li>Ingredient 1</li>
                    <li>Ingredient 2</li>
                    <li>Ingredient 3</li>
                    <li>Ingredient 4</li>
                    <li>Ingredient 5</li>
                    <li>Ingredient 6</li>
                    <li>Ingredient 7</li>
                    <li>Ingredient 8</li>
                </ul>
            </div>
            <?php
            $step_image
            ?>
            <div class="recipe-heading">
                <h2>Recipe Title</h2>
                <h3>Subheading Information blah blah blah</h3>
                <img class="recipe-head-img" src="./content/AdobeStock_235582346.jpeg">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste est ea vero dolorum corrupti labore at maiores. Unde sed corrupti sequi maxime, consectetur vero laudantium cum consequatur ut nihil aperiam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste est ea vero dolorum corrupti labore at maiores. Unde sed corrupti sequi maxime, consectetur vero laudantium cum consequatur ut nihil aperiam.</p>
                <div class="recipe-seperator"></div>
            </div>
                <img class="step-img step1" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step1">
                    <h3>Step 1</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse vitae quos, doloremque iusto libero odit doloribus ipsam velit nihil modi error quaerat sint obcaecati at neque aliquid corrupti temporibus. Ea.</p>    
                </div>
                <img class="step-img step2" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step2">
                    <h3>Step 2</h3>
                    <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae non iure sunt suscipit sapiente deleniti quod provident atque ad quas, odio voluptatum porro. Deserunt eligendi, placeat corporis dignissimos at blanditiis!</P>    
                </div>
                <img class="step-img step3" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step3">
                    <h3>Step 3</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi illum harum dolores aspernatur, sunt reiciendis optio eligendi consequuntur ipsam qui temporibus facere rerum repellat quisquam atque animi in amet quam.</p>
                </div>
                <img class="step-img step4" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step4">
                    <h3>Step 4</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga animi eaque sunt dolores debitis libero dicta dolor voluptas aliquam dolorem doloremque maiores quae, non suscipit assumenda commodi ex pariatur neque.</p>    
                </div>
                <img class="step-img step5" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step5">
                    <h3>Step 5</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, optio sed omnis earum, nostrum quos, odit placeat obcaecati molestiae ipsa voluptate asperiores nemo voluptatibus odio aliquid aspernatur non maiores minima.</p>    
                </div>
                <img class="step-img step6" src="./content/AdobeStock_235582346.jpeg">
                <div class="step-text step6">
                    <h3>Step 6</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, fugit! Eligendi, maxime neque magnam natus, beatae minus ea modi provident at sed ex animi! Quam dolore impedit omnis repellendus autem!</p>    
                </div>
            </div>
            <?php 
               } else{ ?> 
                <p> Recipe Not Found</p>
            <?php   }
                } else { ?>
                    <p> Invalid Recipe ID</p>
            <?php } ?>
    <footer></footer>
</body>
</html>