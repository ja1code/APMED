<?php

$g = $_GET;
include("config.php");

function deletarGenerico($tipo, $id) {
  global $db;
  $sql = "DELETE FROM {$tipo} WHERE id{$tipo} = '$id'";
  $acao = $db->query($sql);
  if ($acao == true) {
    echo "Deletado!";
  } else {
    echo "ERRO_DB";
  }
}


if (isset($g["tipo"])) {
  $tipo = strtolower($g["tipo"]);
  $tipo = ucfirst($tipo);
  deletarGenerico($tipo, $g["id"]);
} else {
  echo "Por favor, informe um tipo";
}


?>