<?php

$p = $_POST;
include("config.php");

function editar($tipo) {
  global $db, $p;
  if ($tipo == 'Medico') {
    $sql = "UPDATE Medico SET crmMedico = '{$p["crm"]}', cpfMedico = '{$p["cpf"]}', nomeMedico = '{$p["nome"]}', nascMedico = '{$p["nasc"]}', endMedico = '{$p["end"]}', emailMedico = '{$p["email"]}', telMedico = '{$p["tel"]}' WHERE idMedico = '{$p["id"]}'";
  } else {
    $sql = "UPDATE {$tipo} SET cpf{$tipo} = '{$p["cpf"]}', nome{$tipo} = '{$p["nome"]}', nasc{$tipo} = '{$p["nasc"]}', end{$tipo} = '{$p["end"]}', email{$tipo} = '{$p["email"]}', tel{$tipo} = '{$p["tel"]}' WHERE id{$tipo} = '{$p["id"]}'";
  }
  $acao = $db->query($sql);
  if ($acao == true) {
    echo "ok!";
  } else {
    echo "ERRO_DB";
  }
}

function editarProntuario () {
  global $db, $p;
  $sql = "UPDATE Prontuario SET DeProntuario = '{$p["desc"]}', nomePaciente = '{$p["nome"]}', nascPaciente = '{$p["nasc"]}', pesoPaciente = '{$p["peso"]}', idadePaciente = '{$p["idade"]}'";
  $acao = $db->query($sql);
  if ($acao == true) {
    echo 'ok!';
  } else {
    echo "ERRO_DB";
  }
}

function editarConsulta () {
  global $db, $p;
  $sql = "UPDATE Consulta SET dataConsulta = '{$p["data"]}', horaConsulta = '{$p["hora"]}', statusConsulta = '{$p["status"]}', prioridadeConsulta = '{$p["prioridade"]}', Medico_idMedico = '{$p["medico"]}', Paciente_idPaciente = '{$p["paciente"]}', Prontuario_idProntuario = '{$p["prontuario"]}'";
  $acao = $db->query($sql);
  if ($acao == true) {
    echo 'ok!';
  } else {
    echo "ERRO_DB";
  }
}

if (isset($p["tipo"])) {
  if ($p["tipo"] == "medico") {
    editar('Medico');
  } else if ($p["tipo"] == "paciente") {
    editar('Paciente');
  } else if ($p["tipo"] == "funcionario") {
    editar('Funcionario');
  } else if ($p["tipo"] == "prontuario") {
    editarProntuario();
  } else if ($p["tipo"] == "consulta") {
    editarConsulta();
  } else {
    echo "Tipo desconhecido";
  }
} else {
  echo "Por favor, informe um tipo";
}

?>