<?php set_include_path("C:\\xampp\\htdocs") ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/searchResults.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

      <style>
        #back-to-top {
          font-size: 2rem;
        }
      </style>

    <title>Github Finder</title>
  </head>

  <body>

    <?php include("p1\\partials\\full-header.php") ?>

    <?php
      if (isset($_SESSION['username'])) {
        include("p1\\partials\\search-container.php");
      }
      else echo '
      <div class="container">
        <h2>Please log in</h2>
      </div>';
    ?>

    <!-- <div class="container">
      <h2>Test</h2>
      <button type="button" id="b0">B0</button>
      <button type="button" id="b1">B1</button>
      <button type="button" id="b2">B2</button>
      <button type="button" id="b3">B3</button>
    </div> -->

    <div id="results-title" class="container" style="display: none;">
      <h2>Search results:</h2>
    </div>

    <div id="searchResults" class="container" style="display: none;">
    </div>

    <div id="repos-title" class="container" style="display: none;">
      <h2>Latest Repos</h2>
    </div>

    <div id="repos" class="containter" style="display: none;">
    </div>

    <?php include("p1\\partials\\back-to-top.php") ?>

    <?php include("p1\\partials\\footer.php") ?>

    <script type="text/javascript" src="js/backToTop.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/initialiseSearchUser.js"></script>
    <script>
      // main file functions area all called <fileName><FileExtension>
      (function () {
        initialiseSearchUser();
        mainJs();
        backToTop();
      })();
    </script>

  </body>

</html>
