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

  $lista = $cliente->listar();
?>
  <nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <span class="navbar-brand">Bem vindo ao CRUD do Bruno</span>
      </li>
      <li class="nav-item">
      </li>
      <li class="nav-item">
        <a class="nav-link" href="form_cliente.php">Cadastro</a>
      </li>
    </ul>
  </nav>
  <div class="container ">
    <div class="alert alert-danger" id="alertError" style="display: none">
      <strong>Ops!</strong> <span id="msgErro"></span>
    </div>
    <div class="alert alert-success" id="alertSuccess" style="display: none">
      <strong>Parabens!</strong> <span id="msgSucess"></span>
    </div>
    <h2>Clientes</h2>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>CPF</th>
          <th>-</th>
        </tr>
      </thead>
      <tbody>
        
        <?php if ($lista['code']!=200){ ?>
          <div class="container">
            <div class="row align-items-center justify-content-center text-center">
              <div class="col-md-10">
                <h1 class="mb-2">
                  <?php echo $lista['message']; ?>
                </h1>
              </div>
            </div>
          </div>
        <?php } else { foreach ($lista['data'] as $itemLista ) { ?>
          <tr>
            <td><?php echo $itemLista['nome']; ?></td>
            <td><?php echo $itemLista['email']; ?></td>
            <td><?php echo $itemLista['cpf']; ?></td>
            <td> 
              <a href="form_cliente.php?idCliente=<?php echo $itemLista['id'] ?>">Ver</a>
            </td>
          </tr>
        <?php } } ?>

      </tbody>
    </table>
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