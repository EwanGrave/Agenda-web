<?php
require_once "model/TaskHandler.php";

if (isset($_GET["action"])){
    switch ($_GET["action"])
    {
        case "add":
            require_once "view/addTask.php";
            break;

        case "del":
            require_once "view/delTask.php";
            break;

        default:
            $res = TaskHandler::selectAll();
            require_once "view/home.php";
            break;
    }
}else{
    $res = TaskHandler::selectAll();
    require_once "view/home.php";
}