<?php
  include('../logica/config.php');
  $pacientes = array();
  $sql = "SELECT * FROM Paciente";
  $act = $db->query($sql);
  if ($act) {
    $nr = $act->num_rows;
    for($a = 0; $a < $nr; $a++) {
      $fetch = $act->fetch_object();
      array_push($pacientes, $fetch);
    }
  }


  $medicos = array();
  $sql = "SELECT * FROM Medico";
  $act = $db->query($sql);
  if ($act) {
    $nr = $act->num_rows;
    for($a = 0; $a < $nr; $a++) {
      $fetch = $act->fetch_object();
      array_push($medicos, $fetch);
    }
  }
?>
<style>
  @import '../extras/styles/main.css';
  .smoll {
    width: 100% !important;
  }
</style>
<div class="ctn-holder">
  <h1>Nova consulta</h1>
  <div class="CNT">
    <div class="row">
      <div class="col-md-9">
        <select class="ipt smoll" id="idPaciente">
          <option value="X">Paciente</option>
          <?php
            for ($i = 0; $i < count($pacientes); $i++) {
              echo "<option value='{$pacientes[$i]->idPaciente}'>{$pacientes[$i]->nomePaciente}</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <input type="text" class="ipt smoll" placeholder="CPF" id="cpfPaciente">
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <input type="text" class="ipt smoll" placeholder="E-mail" id="emailPaciente">
      </div>
      <div class="col-md-1">
        <input type="text" class="ipt smoll" placeholder="DDD" id="ddPaciente">
      </div>
      <div class="col-md-4">
        <input type="text" class="ipt smoll" placeholder="Telefone" id="telPaciente">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <input type="text" class="ipt smoll" placeholder="Endereço" id="enderecoPaciente">
      </div>
      <div class="col-md-3">
        <input type="text" class="ipt smoll" placeholder="CEP" id="cepPaciente">
      </div>
      <div class="col-md-1">
        <input type="text" class="ipt smoll" placeholder="UF" id="ufPaciente">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <select class="ipt smoll" id="idMedico">
          <option value="X">Médico</option>
          <?php
            for ($i = 0; $i < count($medicos); $i++) {
              echo "<option value='{$medicos[$i]->idMedico}'>{$medicos[$i]->nomeMedico}</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-4">
        <input type="text" class="ipt smoll" placeholder="CRM" id="crmMedico">
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        <input type="text" class="ipt smoll" placeholder="Dia" id="dia">
      </div>
      <div class="col-md-1">
        <input type="text" class="ipt smoll" placeholder="Mês" id="mes">
      </div>
      <div class="col-md-1">
        <input type="text" class="ipt smoll" placeholder="Ano" id="ano">
      </div>
      <div class="col-md-3">
        <input type="text" class="ipt smoll" placeholder="Horário" id="horario">
      </div>
      <div class="col-md-6">
        <input type="text" class="ipt smoll" placeholder="Prioridade" id="prioridade">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <input type="text" class="ipt smoll" placeholder="Forma de pagamento" id="formaPgto">
      </div>
      <div class="col-md-6">
        <input type="text" class="ipt smoll" placeholder="Valor" id="valor">
      </div>
    </div>
    <textarea style="width:100%" cols="30" rows="100" class="ipt" id="obs" placeholder="Observações"></textarea>
  </div>
  <div style="text-align: center">
    <button class="btn" onclick="send()">Salvar</button>
  </div>
</div>
<script src="bin/vendor/jquery/jquery.min.js"></script>
<script src="bin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  if (window.location.search.split('=')[1] == 'adc-funcionario') {
    $('#cpf').mask('000.000.000-00', {reverse: true});

    $('#tel').mask('(00) 00000-0000');

    $('#nasc').mask('00/00/0000', {reverse: true});

    $('#end').mask('00000-000', {reverse: true});
  }

  var id
  axios.get(`/logica/info_logica.php?id=${window.location.search.split('=')[2]}&tipo=consulta`)
    .then(r => {
      let da = r.data.data.split('/')
      document.getElementById('dia').value = da[0]
      document.getElementById('mes').value = da[1]
      document.getElementById('ano').value = da[2]
      document.getElementById('horario').value = r.data.horario
      document.getElementById('prioridade').value = r.data.prioridade
      document.getElementById('obs').value = r.data.relatorio
      document.getElementById('idMedico').value = r.data.medico
      document.getElementById('idPaciente').value = r.data.paciente
      id = r.data.id
    })
    .catch(e => {
      console.log(e)
      alert("Não foi possível requisitar os dados, tente novamente")
    })

  function send() {
    let sendobj = {
      tipo: 'consulta',
      data: `${document.getElementById('dia').value}/${document.getElementById('mes').value}/${document.getElementById('ano').value}`,
      hora: document.getElementById('horario').value,
      status: 'pendente',
      prioridade: document.getElementById('prioridade').value,
      relatorio: document.getElementById('obs').value,
      medico: document.getElementById('idMedico').value,
      paciente: document.getElementById('idPaciente').value
    }
    console.log(sendobj)
    axios.post('/logica/cadastro_logica.php', sendobj)
      .then(x => {
        if (x.data == "ok!") {
          alert("Dados inseridos com sucesso!")
          window.location.href = `${window.location.origin}/paginas/dashboard.php`
        }
      })
      .catch(e => {
        console.log(e)
        alert('Não foi possível escrever os dados')
      })

  }
</script>