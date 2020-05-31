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
              echo "<td><a href='?page=edt-paciente&id={$fetch->idPaciente}' class='btn btn-primary'>Editar</a><button onclick='del(${$fetch->idPaciente})' class='btn btn-danger'>Deletar</button></td>";
              echo "</tr>";
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
  function del(id) {
    axios.post(`/logica/deletar_logica.php?id=${id}&tipo=paciente`)
      .then(x => {
        if (x.data == "Deletado!") {
          alert('Item removido com sucesso!')
          window.location.href = "/dashboard.php?page=pacientes"
        } else {
          alert("Erro ao remover item")
        }
      })
      .catch(() => {
        alert("Erro ao remover item")
      })
  }
</script>