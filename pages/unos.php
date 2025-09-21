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
    <main id="article-input-container">
      <form
        name="input-form"
        id="input-form"
        action="skripta.php"
        method="POST"
        enctype="multipart/form-data"
      >
        <label for="title">Article Title:</label>
        <input type="text" id="title" name="title" required />
        <label for="summary">Article summary: </label>
        <textarea
          name="summary"
          id="summary"
          rows="3"
          cols="50"
          required
        ></textarea>
        <label for="text">Article text: </label>
        <textarea name="text" id="text" rows="10" cols="50" required></textarea>
        <div>
          <label for="archive">Archive:</label>
          <input type="checkbox" name="archive" id="archive" />
        </div>
        <label for="category">Article category: </label>
        <select name="category" id="category" required>
          <option value="Sport">Sport</option>
          <option value="Politics">Politics</option>
          <option value="Showbizz">ShowBizz</option>
          <option value="Other">Other</option>
        </select>
        <label for="image">Article image: </label>
        <input type="file" id="image" name="image" accept="image/*" required />
        <input type="submit" value="submit" name="submit" id="sumbit" />
      </form>
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
