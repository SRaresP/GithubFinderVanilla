<?php set_include_path("C:\\xampp\\htdocs") ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
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

    if (!isset($_SESSION['username'])) {
      header('location:index.php');
    }

    ?>

    <?php
      //MISSING PDO INSTANTIATION

      $sql = 'SELECT `id` FROM `user` WHERE `username`="' . $_SESSION['username'] . '"';
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $statement->closeCursor();

      if ($result == array() || $result == null) {
        echo "
          <div class='container'>
            <h2>Error: could not find your username in database.</h2>
          </div>
        ";
      }
      else {
        $userId = $result[0]['id'];

        $sql = 'SELECT * FROM `saved_repo` WHERE `user_id`="' . $userId . '"';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        echo "<div id='url-container' style='display: none;'>";
        for ($index = 0; $index < count($result); $index++) {
          echo $result[$index]['id'] . "ⁿ" . $result[$index]['repo_url'] . "²";
        }
        echo "</div>";
      }
    ?>

    <div class="container">
      <h2>Saved Repos:</h2>
    </div>

    <div id="saved-repos"></div>

    <!-- <div class="container repo-container">
      <div class="repo-part">
        <a href="https://github.com/SRaresP/PocketEncryption" target="_blank"
          class="repo-link">
          <h3 class="repo-title">PocketEncryption</h3>
        </a>
Development source of an app designed to provide offline encryption services for any text, initially, with later possibility to expand into file and folder encryption later.
      </div>
      <div class="repo-part">
        <div class="repo-stat">Forks: 0</div>
        <div class="repo-stat">Watchers: 1</div>
        <div class="repo-stat">Stars: 0</div>
      </div>
    </div>

    <div class="container repo-container">
      <div class="repo-part">
        <a href="https://github.com/SRaresP/GreedyMouse" target="_blank"
          class="repo-link">
          <h3 class="repo-title">GreedyMouse</h3>
        </a>
A tiny Java game in which a cat chases the mouse (the player) around while it
        tries to get as fat as possible
      </div>
      <div class="repo-part">
        <div class="repo-stat">Forks: 0</div>
        <div class="repo-stat">Watchers: 1</div>
        <div class="repo-stat">Stars: 0</div>
      </div>
    </div>

    <div class="container repo-container">
      <div class="repo-part">
        <a href="https://github.com/SRaresP/Github-Finder" target="_blank"
          class="repo-link">
          <h3 class="repo-title">Github-Finder</h3>
        </a>Finds github profiles by name and lists details including the first 5 repos.
        Request data is not filled in for obvious reasons
      </div>
      <div class="repo-part">
        <div class="repo-stat">Forks: 0</div>
        <div class="repo-stat">Watchers: 1</div>
        <div class="repo-stat">Stars: 0</div>
      </div>
    </div> -->

    <?php include("p1\\partials\\back-to-top.php") ?>

    <?php include("p1\\partials\\footer.php") ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/initialiseSavedReposListing.js"></script>
    <script>
      // main file functions area all called <fileName><FileExtension>
      (function () {
        initialiseSavedReposListing();
        mainJs();
      })();
    </script>

  </body>

</html>
