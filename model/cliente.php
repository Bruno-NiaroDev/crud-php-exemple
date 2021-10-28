<?php 

class Cliente {
  
  private $conn;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function cadastrar($nome, $email, $cpf, $senha){

    $sqlCadastrarCliente = "INSERT INTO cliente (nome, email, cpf, senha) VALUES "
    ."('{$nome}', '{$email}', '{$cpf}', MD5('{$senha}'));";

    $stmt = $this->conn->prepare($sqlCadastrarCliente);
    $stmt->execute();
    return $this->conn->lastInsertId();

  }

  public function listar(){
    $sqlListarCliente = "SELECT id, nome, email, cpf FROM cliente;";

    $result = $this->conn->prepare($sqlListarCliente);
    $result->execute();

    if($result->rowCount()>0){

      $return_arr = array(
        "code" => 200,
        "message" => "Cliente(s) encontrado(s) com sucesso.",
        "data" => array()
      );

      while ($row = $result->fetch(PDO::FETCH_ASSOC))
      {
        extract($row);

        $return_item = array(
          "id" => $id,
          "nome" => $nome,
          "email" => $email,
          "cpf" => $cpf
        );
        
        array_push($return_arr["data"], $return_item);
      }
    } else {
      $return_arr = array(
          "code" => 404,
          "message" => "OPS! Não encontramos nenhum cliente.",
          "data" => array()
      );
    }

    return $return_arr;

  }

  public function buscar($idCliente){
    $sqlBuscarCliente = "SELECT id, nome, email, cpf FROM cliente WHERE id = {$idCliente};";

    $return = $this->conn->prepare($sqlBuscarCliente);

    $return->execute();

    if($return->rowCount()>0){
      $return_arr = array(
        "code" => 200,
        "message" => "Cliente encontrado com sucesso.",
        "data" => $return->fetchAll()
      );
    } else {
      $return_arr = array(
        "code" => 404,
        "message" => "Cliente não encontrado.",
        "data" => array()
      );
    }
    return $return_arr;
  }

  public function atulizar($idCliente, $nome, $email, $cpf, $senha){
    
    $novaSenha = $this->checkSenha($idCliente, $senha) && !empty($senha) ? ", senha = MD5('{$senha}')" : "";

    $sqlAtualizarCliente = "UPDATE cliente SET nome = '{$nome}', email = '${email}', cpf = '{$cpf}'{$novaSenha} WHERE id = {$idCliente};";
    
    $stmt = $this->conn->prepare($sqlAtualizarCliente);
    
    if($stmt->execute()){
      return true;
    } else {
      return false;
    }

  }

  public function deletar($idCliente){
    $sqlDeletaCliente = "DELETE FROM cliente where id = {$idCliente};";

    $stmt = $this->conn->prepare($sqlDeletaCliente);
    
    if($stmt->execute()){
      return true;
    } else {
      return false;
    }
  }

  private function checkSenha($idCliente, $novaSenha){
    $sqlBuscarCliente = "SELECT senha FROM cliente WHERE id = {$idCliente};";

    $return = $this->conn->prepare($sqlBuscarCliente);

    $return->execute();

    $senhaAtual = $return->fetchAll();

    return $senhaAtual === md5($novaSenha) ? false : true;

  }
}