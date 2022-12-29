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

      $password = $passwordRetype = $username = $email = "";

      // submission code
      if (isset($_POST['register-submit'])) {

        // Get inputs
        $password = htmlspecialchars($_POST['password-input']);
        $passwordRetype = htmlspecialchars($_POST['password-input-retype']);
        $username = htmlspecialchars($_POST['username-input']);
        $email = filter_var(htmlspecialchars($_POST['email-input']), FILTER_SANITIZE_EMAIL);

        try {
          if (!isset($_POST['username-input']) ||
              !isset($_POST['email-input']) ||
              !isset($_POST['password-input']) ||
              !isset($_POST['password-input-retype'])
          ) {
            throw new MissingRequiredException("One or more required fields were not submitted");
          }

          // Check that passwords match
          if ($password != $passwordRetype) {
            throw new PasswordMatchException("Passwords don't match");
          }
          // Check email
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new NotAnEmailException("Invalid email.");
          }

          //MISSING PDO INSTANTIATION

          // Create user table
          try {
            $sql = "CREATE TABLE user (
              id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              username VARCHAR(127) NOT NULL,
              email VARCHAR(127) NOT NULL,
              password_hash VARCHAR(255) NOT NULL,
              creation_date DATETIME,
              timezone VARCHAR(127),
              PRIMARY KEY(id)
            );";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $statement->closeCursor();
          }
          catch (PDOException) {}

          // Check if username is taken
          $sql = 'SELECT id FROM user WHERE username="' . $username . '"';
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $user_already_exists = $statement->fetchAll(PDO::FETCH_ASSOC) != false;
          $statement->closeCursor();

          if ($user_already_exists) {
            throw new UsernameTakenException("Username is taken.");
          }

          // Check if email is taken
          $sql = 'SELECT id FROM user WHERE email="' . $email . '"';
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $user_already_exists = $statement->fetchAll(PDO::FETCH_ASSOC) != false;
          $statement->closeCursor();

          if ($user_already_exists) {
            throw new EmailTakenException("Email is taken.");
          }

          //Hash the passowrd
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);

          // Insert the user
          // $timezoneName = timezone_name_from_abbr("", 1*3600, false);
          // $currentTime = new DateTime('now', new DateTimeZone('Europe/Bucharest'));
          // $altCurrentTime = new DateTime('now', new DateTimeZone('Europe/Bucharest'));
          // $altCurrentTime->setTimestamp($currentTime->getTimestamp());
          // print_r($altCurrentTime->getTimezone()->getName());
          // print_r(DateTimeZone::listAbbreviations());
          // die();
          $sql = "INSERT INTO user
              (username,
              email,
              password_hash)
            VALUES ('" . $username . "', '" .
              $email . "', '" .
              $passwordHash ."')";
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $insertion_result = $statement->fetchAll(PDO::FETCH_ASSOC);
          $statement->closeCursor();

          $_SESSION['username'] = $username;
          include("p1\\partials\\validation\\user-created.php");
          die();
        }
        catch (PasswordMatchException) {
          include("p1\\partials\\validation\\passwords-match.php");
        }
        catch (NotAnEmailException) {
          include("p1\\partials\\validation\\invalid-email.php");
        }
        catch (UsernameTakenException) {
          include('p1\\partials\\validation\\username-taken.php');
        }
        catch (EmailTakenException) {
          include('p1\\partials\\validation\\email-taken.php');
        }
        catch (MissingRequiredException) {
          include('p1\\partials\\validation\\missing-required.php');
        }
      }
    ?>

    <div class="container">

      <form id="login-form" method="POST" action="register.php">

        <div class="form-area form-group">
          <label for="username-input">Username</label>
          <br>
          <input type="text" class="form-control" id="username-input"
            placeholder="Username" name="username-input" required
            value="<?php echo $username ?>">
          <br><br>
        </div>

        <div class="form-area form-group">
          <label for="email-input">Email address</label>
          <br>
          <input type="email" class="form-control" id="email-input"
            aria-describedby="emailHelp" placeholder="Enter email" name="email-input"
            required value="<?php echo $email ?>">
          <br>
          <small id="emailHelp" class="form-text text-muted">We'll never share your
            email with anyone else.</small>
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

        <div class="form-area form-group">
          <label for="password-input-retype">Retype Password</label>
          <br>
          <input type="password" class="form-control" id="password-input-retype"
            placeholder="Password" name="password-input-retype" required
            value="<?php echo $passwordRetype ?>">
          <br><br>
        </div>

        <div class="form-area form-check">
          <input type="checkbox" class="form-check-input"
            id="data-consent-input" name="data-consent-input" required
            value="false">
            &nbsp;
          <label class="form-check-label" for="data-consent-input">
            I agree to have the data I entered in this form be processed in order to
            use this website.</label>
          <br><br>
        </div>

        <button type="submit" class="btn btn-primary" name="register-submit">Create my account</button>

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
