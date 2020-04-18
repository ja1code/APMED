<?php

$g = $_GET;
include('config.php');

function listagem($tipo) { // Função generica para listar as entidades: Funcionarios, Pacientes e Médicos
  global $db, $g;
  $sql = "SELECT * FROM {$tipo}"; // Seleciona todos os indices de uma váriavel em especifico
  $acao = $db->query($sql);
  if ($acao == true) {
    $nr = $acao->num_rows;
    $resposta = array(); // Array para armazenar todos os resultados
    for ($a = 0; $a < $nr; $a++) { // Realiza um loop pela lista de resultados
      $dados = $acao->fetch_array(MYSQLI_ASSOC); // Busca as propriedades do resultado como uma array
      $entidade = new stdClass; // Cria um objeto para armazenar a resposta
      $entidade->id = $dados["id{$tipo}"];
      if ($tipo == "Medico") { // Caso o tipo seja Medico
        $entidade->crm = $dados["crm{$tipo}"]; // Adiciona o campo crm ao corpo do objeto
      }
      $entidade->cpf = $dados["cpf{$tipo}"];
      $entidade->nome = $dados["nome{$tipo}"];
      $entidade->nasc = $dados["nasc{$tipo}"];
      $entidade->end = $dados["end{$tipo}"];
      $entidade->email = $dados["email{$tipo}"];
      $entidade->tel = $dados["tel{$tipo}"];
      array_push($resposta, $entidade); // Adiciona objeto a array resposta
    }
    echo json_encode($resposta); // Retorna os resultados no formato JSON
  } else {
    return "ERRO_DB";
  }
}

function listagemProntuarios() {
  global $db;
  $sql = "SELECT * FROM Prontuario";
  $acao = $db->query($sql);
  if ($acao == true) {
    $nr = $acao->num_rows;
    $resposta = array();
    for ($a = 0; $a < $nr; $a++) {
      $prontuario = new stdClass;
      $dados = $acao->fetch_object();
      $prontuario->id = $dados->idProntuario;
      $prontuario->desc = $dados->DeProntuario;
      $prontuario->nome = $dados->nomePaciente;
      $prontuario->nasc = $dados->nascPaciente;
      $prontuario->peso = $dados->pesoPaciente;
      $prontuario->idade = $dados->idadePaciente;
      array_push($resposta, $prontuario);
    }
    echo json_encode($resposta);
  } else {
    echo "ERRO_DB";
  }
}

function listagemConsulta() {
  global $db;
  $sql = "SELECT * FROM Consulta
   INNER JOIN Medico ON Consulta.Medico_idMedico = Medico.idMedico 
   INNER JOIN Paciente ON Consulta.Paciente_idPaciente = Paciente.idPaciente 
   INNER JOIN Prontuario ON Consulta.Prontuario_idProntuario = Prontuario.idProntuario";
  $acao = $db->query($sql);
  if ($acao == true) {
    $nr = $acao->num_rows;
    $resposta = array();
    for ($a = 0; $a < $nr; $a++) {
      $consulta = new stdClass;
      $dados = $acao->fetch_object();
      $consulta->id = $dados->idConsulta;
      $consulta->status = $dados->statusConsulta;
      $consulta->prioridade = $dados->prioridadeConsulta;
      $consulta->medico = $dados->nomeMedico;
      $consulta->paciente = $dados->nomePaciente;
      $consulta->prontuario = $dados->DeProntuario;
      $consulta->data = $dados->dataConsulta;
      $consulta->horario = $dados->horaConsulta;
      array_push($resposta, $consulta);
    }
    echo json_encode($resposta);
  } else {
    echo "ERRO_DB";
  }
}

if (isset($g["tipo"])) { // Verifica se o parametro tipo existe
  if ($g["tipo"] == "medico") { // Chama a função especifica para o valor de tipo
    listagem("Medico");
  } else if ($g["tipo"] == "paciente") {
    listagem("Paciente");
  } else if ($g["tipo"] == "funcionario") {
    listagem("Funcionario");
  } else if ($g["tipo"] == "prontuario") {
    listagemProntuarios();
  } else if ($g["tipo"] == "consulta") {
    listagemConsulta();
  } else {
    echo "Tipo desconhecido";
  }
} else { // Caso não exista um tipo, retornar erro
  echo "Por favor, informe um tipo";
}

?>