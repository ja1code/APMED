<?php

  $endereco = "altiorem.dev";
  $usuario = "apmed";
  $senha = "4pm3d2020";
  $nome_db = "apmed";
  $db = new mysqli($endereco, $usuario, $senha, $nome_db);
  $db->set_charset("utf8");
  
?>