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
        <input type="text" class="ipt smoll" placeholder="Nome do paciente" id="nomePaciente">
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
        <input type="text" class="ipt smoll" placeholder="Nome do Médico" id="nomeMedico">
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
    <textarea style="width:100%" name="" id="" cols="30" rows="100" class="ipt" id="obs" placeholder="Observações"></textarea>
  </div>
  <div style="text-align: center">
    <button class="btn">Salvar</button>
  </div>
</div>