<?php

if (isset($_POST["id"])){
    TaskHandler::deleteTask($_POST["id"]);
}

header("Location: index.php");