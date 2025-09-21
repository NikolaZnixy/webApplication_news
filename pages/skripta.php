<?php
include_once 'connect.php';
include_once 'functions.php';
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
    <main id="article-showcase-container">
    <?php
    if(isset($_POST['submit'])){
      echo"<div class='text-section margin-auto'>";
      echo "<h2>Successfully posted.</h2>";
      echo "</div>";
      if(isset($_POST['archive'])){
        echo"<div class='text-section margin-auto'>";
        echo "<h2>Article was saved into archive.</h2>";
        echo "</div>";
      }
        $title=$_POST['title'];
        $summary=$_POST['summary'];
        $category=$_POST['category'];
        $text=$_POST['text'];
        $title=$_POST['title'];
        $archive = isset($_POST['archive']) ? true : false;
        $image=$_FILES['image']['name'];
        $targetDir = "../uploads/"; 
        $image_name=basename($image);
        $targetFile = $targetDir . $image_name;
        echo"<div class='text-section'>";
        echo"<h1>$title</h1>";
        echo "</div>";
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "<img src='$targetFile' alt='Uploaded Image' id='displayImage'>";
          }
        echo"<div class='text-section'>";
        echo"<p><b>$summary</b></p>";
        echo "<p> $text<p>";
        echo "</div>";
        saveArticle($title,$summary,$text,$category,$image_name,$archive);
    }
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
