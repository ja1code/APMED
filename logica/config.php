<?php

  $endereco = "x";
  $usuario = "apmed";
  $senha = "x";
  $nome_db = "apmedv2";
  $db = new mysqli($endereco, $usuario, $senha, $nome_db);
  $db->set_charset("utf8");
  
?>