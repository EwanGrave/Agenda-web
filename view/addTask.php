<?php

if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["deadLine"])){
    $args = [
        "title" => $_POST["title"],
        "description" => $_POST["description"],
        "deadLine" => $_POST["deadLine"]
    ];
    TaskHandler::addTask($args);
}

header("Location: index.php");