<?php
require_once "config.php";

$stmt = $db->prepare(<<<SQL
DELETE FROM task
WHERE idTask = :id
SQL);

$stmt->execute([
    ":id" => $_POST["id"]
]);

header("Location: index.php");