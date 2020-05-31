<?php

include('../logica/config.php');

$sql = "select * from Pagamento inner join Paciente on Pagamento.Paciente_idPaciente = Paciente.idPaciente inner join Funcionario on Pagamento.Funcionario_idFuncionario = Funcionario_idFuncionario";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Pagamentos</h1>
  <div class="table-holder">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Paciente</th>
          <th scope="col">Funcionário</th>
          <th scope="col">Valor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
    
          if (isset($nr)) {
            for ($a = 0; $a < $nr; $a++) {
              $fetch = $act->fetch_object();
              echo "<tr>";
              echo "<td>{$fetch->idPagamento}</td>";
              echo "<td>{$fetch->nomePaciente}</td>";
              echo "<td>{$fetch->nomeFuncionario}</td>";
              echo "<td>{$fetch->valorPagamento}</td>";
              echo "<td><button class='btn btn-primary'>Editar</button><button onclick='del(${$fetch->idPagamento})' class='btn btn-danger'>Deletar</button></td>";
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
    axios.post(`/logica/deletar_logica.php?id=${id}&tipo=pagamentos`)
      .then(x => {
        if (x.data == "Deletado!") {
          alert('Item removido com sucesso!')
          window.location.href = "/dashboard.php?page=pagamentos"
        } else {
          alert("Erro ao remover item")
        }
      })
      .catch(() => {
        alert("Erro ao remover item")
      })
  }
</script>