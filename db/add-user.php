<?php

require("../connection.php");

$pdo = Connection::getConnection();

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRIPPED);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRIPPED);

$userExists = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$userExists->bindValue(':email', $email);
$userExists->execute();

if($userExists->fetch())
{
    header("Location: ../cadastro.php?errorEmail=true");
    exit();
}

if(!empty([$name,$email,$endereco,$telefone]))
{
    $stmt = $pdo->prepare("INSERT INTO users (name,email,address,phone) VALUES (:name,:email,:address,:phone)");
    $stmt->bindValue('name', $name);
    $stmt->bindValue('email', $email);
    $stmt->bindValue('address', $endereco);
    $stmt->bindValue('phone', $telefone);

    if($stmt->execute())
    {
        header("Location: ../cadastro.php?success=true");
        exit();
    }
}