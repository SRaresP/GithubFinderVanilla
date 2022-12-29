<!-- <select>
    <option hidden></option>
    <option>
      <a href="/p1/logout.php">
        <button type="button">Logout</button>
      </a>
    </option>
</select> -->

<div id="user-info" class="dropdown-collapsed">
  <div class="user-info-container">
    <span id="username">
      <?php echo $_SESSION['username'] ?>
    </span>
    <span class="dropdown-arrow arrow down"></span>
  </div>
  <div class="user-info-container user-dropdown user-dropdown-collapsed">
    <div>
      <a href="/p1/logout.php">
        Logout
      </a>
    </div>
    <div>
      <a href="/p1/saved-repos.php">
        Saved repos
      </a>
    </div>
  </div>
</div>
