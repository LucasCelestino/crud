<?php

require("../connection.php");

$pdo = Connection::getConnection();

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRIPPED);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRIPPED);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if(!empty([$name,$email,$endereco,$telefone, $id]))
{
    $userEmail = $pdo->prepare("SELECT email FROM users WHERE id = :id");
    $userEmail->bindValue(':id', $id);
    $userEmail->execute();

    $emailAtual = $userEmail->fetch();

    if($emailAtual['email'] == $email)
    {
            $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, address = :address, phone = :phone WHERE id = :id");
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':address', $endereco);
            $stmt->bindValue(':phone', $telefone);
            $stmt->bindValue(':id', $id);

            if($stmt->execute())
            {
                header("Location: ../edit.php?success=true&id=".$id);
                exit();
            }
    }
    else
    {
        $userExists = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $userExists->bindValue(':email', $email);
        $userExists->execute();

        if($userExists->fetch())
        {
            header("Location: ../edit.php?errorEmail=true&id=".$id);
            exit();
        }
        else
        {
            $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, address = :address, phone = :phone WHERE id = :id");
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':address', $endereco);
            $stmt->bindValue(':phone', $telefone);
            $stmt->bindValue(':id', $id);

            if($stmt->execute())
            {
                header("Location: ../edit.php?success=true&id=".$id);
                exit();
            }
        }
    }
}