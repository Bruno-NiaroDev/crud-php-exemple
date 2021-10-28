<?php

include "../config/database.php";
include "../model/cliente.php";

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['idCliente'])){
    $retorno = $cliente->atulizar($_POST['idCliente'], $_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['senha']);
  
    if($retorno){
      header('Location: ../form_cliente.php?idCliente='.$_POST['idCliente'].'&alertBox=success&alertMessage=Cliente atualizado com sucesso!');
    } else {
      header('Location: ../form_cliente.php?idCliente='.$_POST['idCliente'].'&alertBox=danger&alertMessage=Erro ao atualizar cliente!');
    }

  } else {
    $retorno = $cliente->cadastrar($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['senha']);
  
    if($retorno > 0){
      header('Location: ../form_cliente.php?idCliente='.$retorno.'&alertBox=success&alertMessage=Cliente cadastrado com sucesso!');
    } else {
      header('Location: ../form_cliente.php?&alertBox=danger&alertMessage=Erro ao cadastrar cliente!');
    }
  }
} else {
  if($cliente->deletar($_GET['idCliente'])){
    header('Location: ../index.php?alertBox=success&alertMessage=Cliente excluido com sucesso!');
  } else {
    header('Location: ../index.php?alertBox=danger&alertMessage=Erro ao excluir cliente!');
  }
}
