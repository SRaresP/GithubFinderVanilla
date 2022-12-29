<?php
echo "Saving repo for current user...\n";

// Don't do anything if there is missing data
if (!$_GET['repo_url'] || !$_GET['username']) {
  header("HTTP/1.1 471 Missing data in request.");
  die("Missing data in request.\n");
}

$repoUrl = $_GET['repo_url'];
$username = trim($_GET['username']);

//MISSING PDO INSTANTIATION

// Create saved_repo table
try {
  $sql = "CREATE TABLE saved_repo (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    repo_url VARCHAR(1023) NOT NULL,
    user_id INT(11) UNSIGNED INDEX NOT NULL
    PRIMARY KEY(id)
  );";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $statement->closeCursor();
}
catch (PDOException) {}

// Get user id
$sql = "SELECT `id` FROM `user` WHERE `username`='" . $username . "'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();

if ($result == null) {
  header("HTTP/1.1 472 Github Finder username was not found. Username: " . $username);
  die("Github Finder username was not found.\nUsername: " . $username . "\n");
}

$userId = $result[0]["id"];

// Check if repo is already saved
$sql = "SELECT `id` FROM `saved_repo` WHERE `repo_url`='" . $repoUrl . "' AND `user_id`='" . $userId . "'";
$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();

if ($result != array()) {
  header("HTTP/1.1 473 Repo was already saved by this user.");
  die("Repo was already saved by this user.\n");
}

// Save the repo
$sql = "INSERT INTO saved_repo
    (repo_url,
    user_id)
  VALUES ('" . $repoUrl . "', '" .
    $userId ."')";
$statement = $pdo->prepare($sql);
$statement->execute();
$statement->closeCursor();

echo "Finished saving repo for current user.\n";
?>
