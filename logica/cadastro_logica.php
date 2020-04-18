<?php

$p = $_POST;
include('config.php');

function cadastroGenerico($tipo, $login, $senha) {
  global $db;
  $sql = "INSERT INTO Perfil(DePerfil) VALUES('$tipo')";
  $acao = $db->query($sql);
  if ($acao == true) {
    $acao = $db->query("SELECT MAX(idPerfil) as idPerfil FROM Perfil");
    if ($acao == true) {
      $dados = $acao->fetch_object();
      $idPerfil = $dados->idPerfil;
      $sql = "INSERT INTO Usuario(loginUsuario, senhaUsuario, Perfil_idPerfil) VALUES ('$login', '$senha', '$idPerfil')";
      $acao = $db->query($sql);
      if ($acao == true) {
        $acao = $db->query("SELECT MAX(idUsuario) as idUsuario FROM Usuario");
        if ($acao == true) {
          $dados = $acao->fetch_object();
          return $dados->idUsuario;
        } else {
          return 'ERRO_DB';
        }
      } else {
        return 'ERRO_DB';
      }
    } else {
      return 'ERRO_DB';
    }  
  } else {
    return 'ERRO_DB';
  }
}

function cadastro($tipo) {
  global $p, $db;
  $idUsuario = cadastroGenerico($tipo, $p["cpf"], $p["senha"]);
  if ($tipo == "Medico") {
    $sql = "INSERT INTO Medico(crmMedico, cpfMedico, nomeMedico, nascMedico, endMedico, emailMedico, telMedico, Usuario_idUsuario) VALUES ('{$p["crm"]}', '{$p["cpf"]}', '{$p["nome"]}', '{$p["nasc"]}', '{$p["end"]}', '{$p["email"]}', '{$p["tel"]}', '$idUsuario')";
  } else {
    $sql = "INSERT INTO `apmed`.`{$tipo}` (`cpf{$tipo}`, `nome{$tipo}`, `nasc{$tipo}`, `end{$tipo}`, `email{$tipo}`, `tel{$tipo}`, `Usuario_idUsuario`) VALUES ('{$p["cpf"]}', '{$p["nome"]}', '{$p["nasc"]}', '{$p["end"]}', '{$p["email"]}', '{$p["tel"]}', '$idUsuario')";
  }
  $acao = $db->query($sql);
  if ($acao == true) {
    echo 'ok!';
  }
}

function cadastroProntuario() {
  global $p, $db;
  $sql = "INSERT INTO Prontuario(DeProntuario, nomePaciente, nascPaciente, pesoPaciente, idadePaciente) VALUES('{$p["desc"]}', '{$p["nome"]}', '{$p["nasc"]}', '{$p["peso"]}', '{$p["idade"]}')";
  $acao = $db->query($sql);
  if ($acao == true) {
    echo "ok!";
  } else {
    echo "ERRO_DB";
  }
}

function cadastroConsulta() {
  global $p, $db;
  $sql = "INSERT INTO Consulta(statusConsulta, prioridadeConsulta, Medico_idMedico, Paciente_idPaciente, Prontuario_idProntuario, horaConsulta, dataConsulta) VALUES('{$p["status"]}','{$p["prioridade"]}', '{$p["medico"]}', '{$p["paciente"]}', '{$p["prontuario"]}', '{$p["hora"]}', '{$p["data"]}')";
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
  } else if ($p["tipo"] == "prontuario") {
    cadastroProntuario();
  } else if ($p["tipo"] == "consulta") {
    cadastroConsulta();
  } else {
    echo "Tipo desconhecido";
  }
} else {
  echo "Por favor, informe um tipo";
}
?>