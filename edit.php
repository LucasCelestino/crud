<?php
require("connection.php");

if(isset($_GET['id']))
{
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $stmt = Connection::getConnection()->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
else
{
    header("Location: index.php");
}

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
    <h2>Cadastrar Novo Usuário</h2>
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">
    Usuário adicionado com sucesso!
    </div>
    <?php endif; ?>
    <?php if(isset($_GET['errorEmail'])): ?>
    <div class="alert alert-danger" role="alert">
    E-mail informado já cadastrado.
    </div>
    <?php endif; ?>
    <form method="POST" action="db/add-user.php">
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" value="<?=$user['name'];?>" class="form-control" id="name" placeholder="Digite o nome do usuário...">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?=$user['email'];?>" class="form-control" id="email" placeholder="Digite o email do usuário...">
    </div>
    <div class="form-group">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" value="<?=$user['address'];?>" class="form-control" id="endereco" placeholder="Digite o endereço do usuário...">
    </div>
    <div class="form-group">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" value="<?=$user['phone'];?>" class="form-control" id="telefone" placeholder="Digite o telefone do usuário...">
    </div>
    <input type="submit" class="btn btn-success" value="Cadastrar">
    <a href="index.php" class="ml-2">Voltar para a Home</a>
    </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>