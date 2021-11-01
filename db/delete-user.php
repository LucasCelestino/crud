<?php 
require("../connection.php");


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id)
{
    $stmt = Connection::getConnection()->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindValue(':id', $id);

    if($stmt->execute())
    {
        header("Location: ../index.php");
    }
}