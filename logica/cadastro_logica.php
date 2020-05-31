<?php

$p = file_get_contents('php://input');
$p = json_decode($p, true);
include('config.php');


function cadastroGenerico($tipo, $login, $senha) {
  global $db;
  $sql = "INSERT INTO Usuario (loginUsuario, senhaUsuario) VALUES ('{$login}', '{$senha}')";
  $act = $db->query($sql);
  if ($act) {
    $sql = "SELECT MAX(idUsuario) AS mx FROM Usuario";
    $act = $db->query($sql);
    if ($act) {
      $fetch = $act->fetch_object()->mx;
      $sql = "INSERT INTO Perfil(DePerfil, Usuario_idUsuario) VALUES ('{$tipo}', '{$fetch}')";
      $act = $db->query($sql);
      if ($act) {
        return $fetch;
      } else {
        return 'ERRO_DB';
      }
    } else {
      "ERRO_DB";
    }
  } else {
    return "ERRO_DB";
  }
}

function cadastro($tipo) {
  global $p, $db;
  $idUsuario = cadastroGenerico($tipo, $p["cpf"], $p["senha"]);
  if ($idUsuario !== 'ERRO_DB') {
    if ($tipo == "Medico") {
      $sql = "INSERT INTO Medico(crmMedico, cpfMedico, nomeMedico, endMedico, emailMedico, telMedico, Usuario_idUsuario) VALUES ('{$p["crm"]}', '{$p["cpf"]}', '{$p["nome"]}', '{$p["end"]}', '{$p["email"]}', '{$p["tel"]}', '$idUsuario')";
    } else {
      if ($tipo == "Admin") {
        $tipo = "Funcionario";
      }
      $sql = "INSERT INTO `apmedv2`.`{$tipo}` (`cpf{$tipo}`, `nome{$tipo}`, `nasc{$tipo}`, `end{$tipo}`, `email{$tipo}`, `tel{$tipo}`, `Usuario_idUsuario`) VALUES ('{$p["cpf"]}', '{$p["nome"]}', '{$p["nasc"]}', '{$p["end"]}', '{$p["email"]}', '{$p["tel"]}', '$idUsuario')";
    }
    $acao = $db->query($sql);
    if ($acao == true) {
      echo 'ok!';
    }
  } else {
    echo 'ERRO_DB';
  }
}


function cadastroConsulta() {
  global $p, $db;
  $sql = "INSERT INTO Consulta(statusConsulta, prioridadeConsulta, Medico_idMedico, Paciente_idPaciente, relatorioConsulta, horaConsulta, dataConsulta) VALUES('{$p["status"]}','{$p["prioridade"]}', '{$p["medico"]}', '{$p["paciente"]}', '{$p["relatorio"]}', '{$p["hora"]}', '{$p["data"]}')";
  $acao = $db->query($sql);
  if ($acao == true) {
    echo "ok!";
  } else {
    echo "ERRO_DB";
  }
}

if (isset($p["tipo"])) {
  if ($p["tipo"] == "medico") {
    cadastro("Medico");
  } else if ($p["tipo"] == "paciente") {
    cadastro("Paciente");
  } else if ($p["tipo"] == "funcionario") {
    cadastro("Funcionario");
  } else if ($p["tipo"] == "consulta") {
    cadastroConsulta();
  } else {
    echo "Tipo desconhecido";
  }
} else {
  echo "Por favor, informe um tipo";
}
?>