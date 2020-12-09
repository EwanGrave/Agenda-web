<?php
require_once "config.php";
require_once "compareDates.php";

$stmt = $db->prepare(<<<SQL
SELECT * FROM task
ORDER BY deadLine ASC;
SQL);

$stmt->execute(array());

$res = $stmt->fetchAll();

$body = <<<HTML
<div id="content-title">
    <span>L'Agenda</span>
</div>
<form id="formAdd" action="addTask.php" method="post">
    <div class="input">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" placeholder="Titre" required>
    </div>
    <div class="input">
        <label for="deadLine">Date limite</label>
        <input type="date" id="deadLine" name="deadLine" placeholder="Date limite" required>
    </div>
    <div class="input">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="3" required placeholder="Description"></textarea>
    </div>
    <input type="submit" class="submit" value="Ajouter">
</form>

HTML;

if (count($res) != 0){
    $body .= "<div id='numbers'>";

    $n = count($res);
    $m = 0;
    for ($i = 0; $i < $n; $i++) {
        $deadline = date("d/m/Y", strtotime($res[$i]["deadLine"]));
        if (!compareDates(date("d/m/Y"), $deadline))
            $m++;
    }

    $body .= <<<HTML
        {$n} tâches, {$m} tâche(s) en retard
    </div>

    <div id="tasks">
    HTML;

    for ($i = 0; $i < count($res); $i++){
        $deadline = date("d/m/Y", strtotime($res[$i]["deadLine"]));
        $now = date("d/m/Y");
        if (!compareDates($now, $deadline))
            $class = "after-dead-line";
        else
            $class = "before-dead-line";

        $body .= <<<HTML
        <div class="task {$class}">
            <div class="task-top">
                <span class="title">{$res[$i]["title"]}</span>
                <span class="deadLine">Pour le {$deadline}</span>
            </div>
            <div class="description">{$res[$i]["description"]}</div>
            <form method="post" action="delTask.php">
                <input type="hidden" name="id" value="{$res[$i]["idTask"]}">
                <input type="submit" class="submit" value="Supprimer">
            </form>
        </div>
        HTML;
    }
}else{
    $body .= <<<HTML
    <div id="nothing">Aucune tâche !</div>
    HTML;
}

$body .= "</div>";

require_once "template.html";