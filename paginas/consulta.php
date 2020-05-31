<?php

include('../logica/config.php');

$sql = "select * from Consulta inner join Medico on Consulta.Medico_idMedico = Medico.idMedico inner join Paciente on Consulta.Paciente_idPaciente = Paciente.idPaciente;";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Consultas</h1>
  <div class="controls">
  <a role="button" href="?page=adc-consulta" class="btn btn-success" >Adicionar nova consulta</a>
  </div>
  <div class="table-holder">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Status</th>
          <th scope="col">Prioridade</th>
          <th scope="col">Médico</th>
          <th scope="col">Pàciente</th>
          <th scope="col">Data</th>
          <th scope="col">Hora</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
    
          if (isset($nr)) {
            for ($a = 0; $a < $nr; $a++) {
              $fetch = $act->fetch_object();
              echo "<tr>";
              echo "<td>{$fetch->statusConsulta}</td>";
              echo "<td>{$fetch->prioridadeConsulta}</td>";
              echo "<td>{$fetch->nomeMedico}</td>";
              echo "<td>{$fetch->nomePaciente}</td>";
              echo "<td>{$fetch->dataConsulta}</td>";
              echo "<td>{$fetch->horaConsulta}</td>";
              echo "<td><a href='?page=edt-consulta&id={$fetch->idConsulta}' class='btn btn-primary'>Editar</a><button onclick='del(${$fetch->idConsulta})' class='btn btn-danger'>Deletar</button></td>";
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
    axios.post(`/logica/deletar_logica.php?id=${id}&tipo=consulta`)
      .then(x => {
        if (x.data == "Deletado!") {
          alert('Item removido com sucesso!')
          window.location.href = "/dashboard.php?page=consultas"
        } else {
          alert("Erro ao remover item")
        }
      })
      .catch(() => {
        alert("Erro ao remover item")
      })
  }
</script>