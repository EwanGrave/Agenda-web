<?php
require_once "config.php";

$stmt = $db->prepare(<<<SQL
INSERT INTO task (title, description, deadLine)
VALUES (:title, :description, :deadLine);
SQL);

$stmt->execute([
    ":title" => $_POST["title"],
    ":description" => $_POST["description"],
    ":deadLine" => $_POST["deadLine"]
]);

header("Location: index.php");