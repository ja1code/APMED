<?php

include('../logica/config.php');

$sql = "select * from Medico inner join Usuario on Medico.Usuario_idUsuario = Usuario.idUsuario";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Médicos</h1>
  <div class="controls">
    <button class="btn btn-success">Adicionar novo médico</button>
  </div>
  <div class="table-holder">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">CPF</th>
          <th scope="col">CRM</th>
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
              echo "<td>{$fetch->cpfMedico}</td>";
              echo "<td>{$fetch->crmMedico}</td>";
              echo "<td>{$fetch->nomeMedico}</td>";
              echo "<td>{$fetch->nascMedico}</td>";
              echo "<td>{$fetch->emailMedico}</td>";
              echo "<td>{$fetch->telMedico}</td>";
              echo "<td>{$fetch->endMedico}</td>";
              echo "<td><button class='btn btn-primary'>Editar</button></td>";
              echo "</tr>";
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>