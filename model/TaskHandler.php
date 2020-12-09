<?php

class TaskHandler{
    public static function addTask(array $args): void
    {
        $db = self::getPDO();
        $stmt = $db->prepare(<<<SQL
        INSERT INTO task (title, description, deadLine)
        VALUES (:title, :description, :deadLine);
        SQL);

        $stmt->execute([
            ":title" => $args["title"],
            ":description" => $args["description"],
            ":deadLine" => $args["deadLine"]
        ]);
    }

    public static function deleteTask(int $id): void
    {
        $db = self::getPDO();
        $stmt = $db->prepare(<<<SQL
        DELETE FROM task
        WHERE idTask = :id
        SQL);

        $stmt->execute([
            ":id" => $id
        ]);
    }

    public static function selectAll(): array
    {
        $db = self::getPDO();
        $stmt = $db->prepare(<<<SQL
        SELECT * FROM task
        ORDER BY deadLine ASC;
        SQL);

        $stmt->execute(array());

        return $stmt->fetchAll();
    }

    private static function getPDO(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=todo','root','');
    }

    public static function compareDates(string $date1, string $date2): bool
    {
        $date1 = explode("/", $date1);
        $date2 = explode("/", $date2);
        
        if ((int)$date1[2] < (int)$date2[2]){
            return true;
        }else{
            if ((int)$date1[1] < (int)$date2[1]){
                return true;
            }else{
                if ((int)$date1[0] < (int)$date2[0]){
                    return true;
                }
            }
        }
        return false;
    }
}