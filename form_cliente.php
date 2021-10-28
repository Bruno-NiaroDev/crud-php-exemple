<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD do Bruno - Listagem</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
  include "./config/database.php";
  include "./model/cliente.php";

  $database = new Database();
  $db = $database->getConnection();

  $cliente = new Cliente($db);

  $clienteDado = $cliente->buscar($_GET['idCliente']);
?>
  <nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <span class="navbar-brand">Bem vindo ao CRUD do Bruno</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Listagem</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="form_cliente.php">Cadastro</a>
      </li>
    </ul>
  </nav>
  
  <div class="container ">
    <h2>Cadastro de Cliente</h2>
    <form action="./controller/cliente.php" method="post">
      <div class="alert alert-danger" id="alertError" style="display: none">
        <strong>Ops!</strong> <span id="msgErro"></span>
      </div>
      <div class="alert alert-success" id="alertSuccess" style="display: none">
        <strong>Parabens!</strong> <span id="msgSucess"></span>
      </div>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" value="<?php echo $clienteDado['code'] == 200 ? $clienteDado['data'][0]['nome'] : ''; ?>" required>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">@</span>
        </div>
        <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" value="<?php echo $clienteDado['code'] == 200 ? $clienteDado['data'][0]['email'] : ''; ?>" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="CPF (XXX.XXX.XXX-XX)" id="cpf" name="cpf" value="<?php echo $clienteDado['code'] == 200 ? $clienteDado['data'][0]['cpf'] : ''; ?>" required>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">ꗄ</span>
        </div>
        <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" <?php echo $clienteDado['code'] == 200 ? '' : 'required'; ?> >
      </div>
      <button type="submit" class="btn btn-primary"><?php echo isset($_GET['idCliente']) ? 'Atualizar' : 'Cadastrar' ?></button>
      <?php if (isset($_GET['idCliente'])){ ?>
        <a href="./controller/cliente.php?idCliente=<?php echo $_GET['idCliente']; ?>" class="btn btn-danger">Excluir</a>
        <input type="number" class="form-control" id="idCliente" name="idCliente" value="<?php echo $clienteDado['data'][0]['id']; ?>" style="display: none">
      <?php } ?>
      

    </form>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  <?php if($_GET['alertBox'] == 'danger'){?>
    $("#alertError").fadeIn(3000);
    $("#msgErro").text("<?php echo $_GET['alertMessage']; ?>")
  <?php } ?>

  <?php if($_GET['alertBox'] == 'success'){?>
    $("#alertSuccess").fadeIn(3000);
    $("#msgSucess").text("<?php echo $_GET['alertMessage']; ?>")
  <?php } ?>
</script>
</body>
</html>