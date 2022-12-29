<?php set_include_path("C:\\xampp\\htdocs") ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login-register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

    <title>Github Finder</title>
  </head>

  <body>

    <?php include("p1\\partials\\full-header.php") ?>

    <?php
      if (isset($_SESSION['username'])) {
        header('location:index.php');
        die();
      }

      require_once("p1\\validation\\exceptions.php");

      $password = $email = "";

      // submission code
      if (isset($_POST['login-submit'])) {

        // Get inputs
        $password = htmlspecialchars($_POST['password-input']);
        $email = filter_var(htmlspecialchars($_POST['email-input']), FILTER_SANITIZE_EMAIL);

        try {
          if (!isset($_POST['email-input']) ||
              !isset($_POST['password-input'])
          ) {
            throw new MissingRequiredException("One or more required fields were not submitted");
          }

          // Check email
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new NotAnEmailException("Invalid email.");
          }

          //MISSING PDO INSTANTIATION

          $sql = 'SELECT * FROM `user` WHERE `email`="' . $email . '"';
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);
          $statement->closeCursor();

          if ($result == array()) {
            throw new UsernameNotFoundException("Username not found.");
          }

          $user = $result[0];

          // Check the password
          if (password_verify($password, $user['password_hash'])) {
            throw new WrongPasswordException();
          }

          $_SESSION['username'] = $user['username'];
          header("location:index.php");
          die();
        }
        catch (MissingRequiredException) {
          include('p1\\partials\\validation\\missing-required.php');
        }
        catch (NotAnEmailException) {
          include("p1\\partials\\validation\\invalid-email.php");
        }
        catch (UsernameNotFoundException) {
          include('p1\\partials\\validation\\username-not-found.php');
        }
        catch (WrongPasswordException) {
          include("p1\\partials\\validation\\wrong-password.php");
        }
      }
    ?>

    <div class="container">
      <form id="login-form" method="POST" action="login.php">

        <div class="form-area form-group">
          <label for="email-input">Email address</label>
          <br>
          <input type="email" class="form-control" id="email-input"
            aria-describedby="emailHelp" placeholder="Enter email" name="email-input"
            required value="<?php echo $email ?>">
          <br><br>
        </div>

        <div class="form-area form-group">
          <label for="password-input">Password</label>
          <br>
          <input type="password" class="form-control" id="password-input"
            placeholder="Password" name="password-input" required
            value="<?php echo $password ?>">
          <br><br>
        </div>

        <a href="/p1/register.php">
          <button type="button" class="btn btn-primary">No account? Create one</button>
        </a>
        <button type="submit" class="btn btn-primary" name="login-submit">Login</button>

      </form>
    </div>

    <?php include("p1\\partials\\back-to-top.php") ?>

    <?php include("p1\\partials\\footer.php") ?>

    <script type="text/javascript" src="js/backToTop.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script>
      // main file functions area all called <fileName><FileExtension>
      (function () {
        mainJs();
        backToTop();
      })();
    </script>
  </body>
</html>
