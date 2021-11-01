<?php
require("connection.php");

$stmt = Connection::getConnection()->prepare("SELECT * FROM users");
$stmt->execute();

$allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body>
    <div class="container p-5">
    <table class="table">
    <a href="cadastro.php" class="btn btn-success mb-4 mr-2">Adicionar Novo Usuário</a>
    <a href="db/delete-all.php" class="btn btn-danger mb-4">Deletar Todos os Registros</a>
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Endereço</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($allUsers) && !empty($allUsers)): ?>
      <?php foreach ($allUsers as $user): ?>
      <tr class="border-bottom">
        <td><?=$user['name'];?></td>
        <td><?=$user['email'];?></td>
        <td><?=$user['address'];?></td>
        <td><?=$user['phone'];?></td>
        <td>
          <a href="edit.php?id=<?=$user['id'];?>" class="text-success mr-2">Editar</a>
          <a href="db/delete-user.php?id=<?=$user['id'];?>" class="text-danger">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php else: ?>
        <tr class="border-bottom">
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>
          -
        </td>
      </tr>
      <?php endif; ?>
    </tbody>
    </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>