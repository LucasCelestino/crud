<?php 
require("../connection.php");

$stmt = Connection::getConnection()->prepare("DELETE FROM users");

if($stmt->execute())
{
    header("Location: ../index.php");
}