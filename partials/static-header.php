<?php set_include_path("C:\\xampp\\htdocs") ?>
<?php
if(session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
?>

<div id="static-header">
  <div id="main-title">
    <a href="/p1/">
      <h1>Github Finder</h1>
    </a>
  </div>
  <div id="header-button-container">
    <?php
      if (isset($_SESSION['username'])) {
        include("p1\\partials\\user-info.php");
      }
      else {
        include("p1\\partials\\login-button.php");
      }
    ?>
  </div>
</div>
