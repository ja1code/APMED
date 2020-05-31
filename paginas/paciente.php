<?php

include('../logica/config.php');

$sql = "select * from Paciente inner join Usuario on Paciente.Usuario_idUsuario = Usuario.idUsuario";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Pacientes</h1>
  <div class="controls">
    <a role="button" href="?page=adc-paciente" class="btn btn-success" >Adicionar novo funcionario</a>
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
              echo "<td>{$fetch->cpfPaciente}</td>";
              echo "<td>{$fetch->nomePaciente}</td>";
              echo "<td>{$fetch->nascPaciente}</td>";
              echo "<td>{$fetch->emailPaciente}</td>";
              echo "<td>{$fetch->telPaciente}</td>";
              echo "<td>{$fetch->endPaciente}</td>";
              echo "<td><a href='?page=edt-medico' class='btn btn-primary'>Editar</a></td>";
              echo "</tr>";
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>