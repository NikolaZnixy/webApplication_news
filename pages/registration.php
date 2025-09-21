<?php
    include_once "connect.php";     
    include_once "functions.php" ;
    session_start();
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
        <main id="register-container">
            <form  action="registration.php" method="POST" id="register-form">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <label for="retypePassword">Password Re type</label>
                <input type="password" name="retypePassword" id="retypePassword">
                <input type="submit" value="register" name="register_submit" id="register_submit">
            </form>
            <?php
                        if(isset($_POST['register_submit'])){
                            $firstName=$_POST['firstName'];
                            $lastName=$_POST['lastName'];
                            $username=$_POST['username'];
                            $password=$_POST['password'];
                            $retypePassword=$_POST['retypePassword'];
                            $chkExistingQuery="Select username from korisnici where username=? limit 1";
                            $chkExistingStmt=mysqli_stmt_init($dbc);
                            if(mysqli_stmt_prepare($chkExistingStmt,$chkExistingQuery)){
                                mysqli_stmt_bind_param($chkExistingStmt,'s',$username);
                                mysqli_stmt_execute($chkExistingStmt);
                                mysqli_stmt_store_result($chkExistingStmt);
                            }
                            if(mysqli_stmt_num_rows($chkExistingStmt)>0){
                                echo "<h2 style='text-align:center; margin-top:30px'>User already exists, choose another username</h2>";

                            }else{
                                if($password!=$retypePassword){
                                    echo "<h2 style='text-align:center; margin-top:30px'>Passwords do not match</h2>";
                                }else{
                                    $permission = 0;
                                    $hashedPassword=password_hash($password, PASSWORD_BCRYPT);
                                    $insertQuery="insert into korisnici (ime,prezime,username,pass,permission)  values (?,?,?,?,?)";
                                    $insertStmt=mysqli_stmt_init($dbc);
                                    if(mysqli_stmt_prepare($insertStmt,$insertQuery)){
                                        mysqli_stmt_bind_param($insertStmt,'ssssi',$firstName,$lastName,$username,$hashedPassword,$permission);
                                        if(mysqli_stmt_execute($insertStmt)){
                                            echo "<h2 style='text-align:center; margin-top:30px'>$username successfully registered!</h2>";
                                            $_SESSION["username"]=$username;
                                            $_SESSION["password"]=$hashedPassword;
                                            $_SESSION["permission"]=$permission;
                                            $_SESSION["firstName"]=$firstName;
                                            $_SESSION["lastName"]=$lastName;
                                            header("location: ../index.php");
                                        }else{
                                            echo "<h2 style='text-align:center; margin-top:30px'>Error: could not add user.</h2>";
                                        }
                                    }
                                    if(mysqli_stmt_num_rows($insertStmt)>0){
                                        mysqli_stmt_bind_result($insertStmt, $returnedUsername, $returnedPassword,$returnedPermission);
                                        /*Dohvaca rezultate prvog retka*/
                                        mysqli_stmt_fetch($insertStmt);
                                    }
                                }
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