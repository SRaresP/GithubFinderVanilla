<?php set_include_path("C:\\xampp\\htdocs") ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

    <title>About</title>

  </head>
  <body>

    <?php include("partials\\full-header.php"); ?>

    <div class="container">
      <h3>What can you use this site for?</h3>
      <p>You can search for Github profiles and save their repositories for later reference. The website can find any profile using its username, and automatically lists information about it.</p>
    </div>

    <div class="container">
      <h3>How is it done?</h3>
      <p>It's done by using Github's API, which allows us to query github for all sorts of information. Here is a link to the <a href="https://docs.github.com/en/rest?apiVersion=2022-11-28" target="_blank"> API documentation</a>.</p>
    </div>

    <div class="container">
      <h3>I don't want people to be able to find my profile using Github Finder!</h3>
      <p>Don't worry, only public profiles and repositories can be found by this website. Github has you covered without any more help from us.</p>
    </div>

    <div class="container">
      <h3>Credits</h3>
      <h4>The creators of the tutorial series that have taught me the basics of web
      development and more.</h4>
      <a href="https://www.youtube.com/@TraversyMedia" title="Traversy Media" target="_blank">Traversy Media</a>
      <h4>Website Favicon</h4>
      <img class="about-favicon" src="../favicon.png" height="25px" width="auto">
      <a href="https://www.flaticon.com/free-icons/github" title="github icons" target="_blank">Github
        icons created by IconKanan - Flaticon</a>
      <h4>External code</h4>
      <a href="https://www.w3schools.com/howto/howto_html_include.asp" title="w3schools html import" target="_blank">
        w3schools code for importing html (not actually used anymore in the website)
      </a>
    </div>

    <?php include("partials\\back-to-top.php") ?>

    <?php include("partials\\footer.php") ?>

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

