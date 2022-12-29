<?php
echo "Deleting repo\n";

// Don't do anything if there is missing data
if (!$_GET['repo_id']) {
  header("HTTP/1.1 470 Missing repo id in request.");
  die("Missing repo id in request.\n");
}

$repoId = $_GET['repo_id'];

//MISSING PDO INSTANTIATION

// Save the repo
$sql = "DELETE FROM `saved_repo` WHERE `id`='" . $repoId . "';";
$statement = $pdo->prepare($sql);
$statement->execute();
$statement->closeCursor();

echo "Finished deleting repo for current user.\n";
?>
