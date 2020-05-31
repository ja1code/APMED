<?php

$g = $_GET;
include('config.php');

if (isset($g['id'])) {
  $sql = "select * from Perfil where Usuario_idUsuario = '{$g['id']}'";
  $act = $db->query($sql);
  if ($act == true) {
    $fetch = $act->fetch_array(MYSQLI_ASSOC);
    $tipo = $fetch['DePerfil'];
    if ($tipo === "Admin") {
      $tipo = "Funcionario";
    }
    $sql = "select * from Usuario inner join {$tipo} on Usuario.idUsuario = {$tipo}.Usuario_idUsuario where idUsuario = {$g['id']}";
    $act = $db->query($sql);
    if ($act) {
      $fetch = $act->fetch_object();
      echo json_encode($fetch);
    } else {
      if ($tipo == "admin") {
        echo '{"nome": "admin"}';
      } else {
        echo 'error';
      }
    }
  }
} else {
  echo '{"status": "Error"}';
}

?>