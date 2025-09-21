<?php
include_once "connect.php";     
include_once "functions.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unos</title>
    <link rel="stylesheet" href="../styles/styles.css" />
  </head>
  <body>
  <header>
      <?php
      if(isset($_SESSION["username"])){
        echo "<section id='user-track'>";
        echo "<h3>" . $_SESSION["username"] . "</h3>"; 
        echo "<a href='logout.php'><button>logout</button></a>"; 
        echo "</section>";
      }
      ?>
      <figure>
        <img src="../resources/BZ-logo.png" alt="bz-logo-characters" />
      </figure>
      <nav>
        <div class="nav-item">
          <a href="../index.php"><h3>Home</h3></a>
        </div>
        <div class="nav-item">
          <a href="berlin-sport.php"><h3>Berlin-sport</h3></a>
        </div>
        <div class="nav-item">
          <a href="kultur.php"><h3>Kultur Und Show</h3></a>
        </div>
        <?php
      if(isset($_SESSION["username"]) && $_SESSION["permission"]==1){
        echo '<div class="nav-item">';
        echo '  <a href="administracija.php"><h3>Administracija</h3></a>';
        echo '</div>';
        echo '<div class="nav-item">';
        echo '  <a href="unos.php"><h3>Unos</h3></a>';
        echo '</div>';
      }
      ?>
      <?php
      if(!isset($_SESSION["username"])){
        echo '<div class="nav-item">';
        echo '  <a href="login.php"><h3>Log in</h3></a>';
        echo '</div>';
      }
      ?>
        <div class="nav-item hoverShow">
            <h3>Categories</h3>
            <form class="dropdown-content" method="POST" action="kategorije.php">
                <button type="submit" name="categoryChoose" value="1">Politics</button>
                <button type="submit" name="categoryChoose" value="2">ShowBizz</button>
                <button type="submit" name="categoryChoose" value="3">Sport</button>
                <button type="submit" name="categoryChoose" value="4">Others</button>
            </form>
    </div>
        </div>
      </nav>
    </header>
    <main id="article-input-container">
        <?php
        $row=getArticle($_GET['id']);
        $targetDir = "../uploads/"; 
        $image_name=$row['imagePath'];
        $targetFile = $targetDir . $image_name;
        echo '<form action="articleEdit.php" method="POST" enctype="multipart/form-data">';
        echo '  <input type="number" id="article-id" name="article-id" value="' . $row['id'] . '" hidden />';
        echo '  <label for="title">Article Title:</label>';
        echo '  <input type="text" id="title" name="title" value="' . $row['title'] . '" required />';
        echo '  <label for="summary">Article summary: </label>';
        echo '  <textarea name="summary" id="summary" rows="3" cols="50" required>' .  htmlspecialchars($row['summary'])  .'</textarea>';
        echo '  <label for="text">Article text: </label>';
        echo '  <textarea name="text" id="text" rows="10" cols="50" required>' .  htmlspecialchars($row['content'])  .'</textarea>';
        echo '  <div>';
        echo '    <label for="archive">Archive:</label>';
        echo '    <input type="checkbox" name="archive" id="archive" />';
        echo '  </div>';
        echo '  <label for="category">Article category: </label>';

        $categoryName = determineCategory($row['category']); 
        $categories = ["Sport", "Politics", "Showbizz", "Other"];
        
        echo '<select name="category" id="category" required>';
        foreach ($categories as $cat) {
            $selected = (strtolower($cat) == strtolower($categoryName)) ? ' selected' : '';
            echo "<option value=\"$cat\"$selected>$cat</option>";
        }
        echo '</select>';
        echo "<img src='$targetFile' alt='Uploaded Image' id='displayImage' class='margin-top-md'>";
        echo '  <label for="image">Change article image: </label>';
        echo '  <input type="file" id="image" name="image-edit" accept="image/*"  />';
        echo '  <input type="submit" value="delete" name="delete-article" id="delete" />';
        echo '  <input type="submit" value="edit" name="edit-article" id="edit" />';
        echo '</form>';
        

        ?>
    </main>
    <footer>
      <section>
        <div id="footer-up">
          <h4>Weitere Online-Angebote der Axel Springer SE:</h4>
        </div>
        <div id="footer-down"></div>
      </section>
    </footer>
  </body>
</html>
