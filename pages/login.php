    <?php
    session_start();
    include "connect.php";     
    include "functions.php" ;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BZ Berlin</title>
        <link rel="stylesheet" href="../styles/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        echo '  <a href="unos.html"><h3>Unos</h3></a>';
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
        <main id="login-container">
            <form  action="login.php" method="POST" id="login-form">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="log in" name="login_submit" id="login_submit">
            </form>
            <?php
            if(isset($_POST['login_submit'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                $hashedPassword=password_hash($password, PASSWORD_BCRYPT);
                $query="Select ime,prezime,username,pass,permission from korisnici where username=? limit 1";
                $stmt=mysqli_stmt_init($dbc);
                if(mysqli_stmt_prepare($stmt,$query)){
                    mysqli_stmt_bind_param($stmt,'s',$username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
                if(mysqli_stmt_num_rows($stmt)>0){
                    mysqli_stmt_bind_result($stmt,$returnedIme,$returnedPrezime, $returnedUsername, $returnedPassword,$returnedPermission);
                    /*Dohvaca rezultate prvog retka*/
                    mysqli_stmt_fetch($stmt);
                    if(password_verify($password,$returnedPassword)){
                        $_SESSION["username"]=$returnedUsername;
                        $_SESSION["password"]=$returnedPassword;
                        $_SESSION["permission"]=$returnedPermission;
                        $_SESSION["firstName"]=$returnedIme;
                        $_SESSION["lastName"]=$returnedPrezime;
                        header("location: ../index.php");
                    }else{
                        echo "<h2 style='text-align:center; margin-top:30px'>Wrong Username Or Password</h2>";
                    }
                }else{
                    echo "<h2 style='text-align:center; margin-top:30px'>User does not exist</h2>";
                    echo '<a href="registration.php" id="registration-link"><button>Register</button></a>"';
                }
                

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