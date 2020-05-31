<?php

include('../logica/config.php');

$sql = "select * from Funcionario inner join Usuario on Funcionario.Usuario_idUsuario = Usuario.idUsuario";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Funcionários</h1>
  <div class="controls">
    <a role="button" href="?page=adc-funcionario" class="btn btn-success" >Adicionar novo funcionario</a>
  </div>
  <div class="table-holder">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">CPF</th>
          <th scope="col">Nome</th>
          <th scope="col">Data de nascimento</th>
          <th scope="col">E-mail</th>
          <th scope="col">Telefone</th>
          <th scope="col">Endereço</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
    
          if (isset($nr)) {
            for ($a = 0; $a < $nr; $a++) {
              $fetch = $act->fetch_object();
              echo "<tr>";
              echo "<td>{$fetch->cpfFuncionario}</td>";
              echo "<td>{$fetch->nomeFuncionario}</td>";
              echo "<td>{$fetch->nascFuncionario}</td>";
              echo "<td>{$fetch->emailFuncionario}</td>";
              echo "<td>{$fetch->telFuncionario}</td>";
              echo "<td>{$fetch->endFuncionario}</td>";
              echo "<td><a href='?page=edt-funcionario&id={$fetch->idFuncionario}' class='btn btn-primary'>Editar</a></td>";
              echo "</tr>";
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>