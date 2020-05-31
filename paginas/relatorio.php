<style>
  @import '../extras/styles/main.css';

  .smoll {
    width: 100% !important;
  }
</style>
<div class="container">
  <h1>Relatório</h1>
  <div class="row">
    <div class="col-md-9">
      <input type="text" name="" id="" class="ipt smoll" placeholder="Nome do paciente">
    </div>
    <div class="col-md-3">
      <input type="text" name="" id="" class="ipt smoll" placeholder="Data de nascimento">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <input type="text" name="" id="" class="ipt smoll" placeholder="Data da consulta">
    </div>
    <div class="col-md-3">
      <input type="text" name="" id="" class="ipt smoll" placeholder="Altura">
    </div>
    <div class="col-md-3">
      <input type="text" name="" id="" class="ipt smoll" placeholder="Peso (kg)">
    </div>
  </div>
  <div> 
    <p style="margin:0;">Sexo:</p>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="sexo" id="sexo" value="masc" checked>
      <label class="form-check-label" for="masc">
        Masculino
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="sexo" id="sexo" value="fem">
      <label class="form-check-label" for="fem">
        Feminino
      </label>
    </div>
  </div>
  <div style="width: 100%">
    <h3>Descrição da consulta</h3>
    <textarea name="obs" class="ipt smoll" id="obs" cols="30" rows="10"></textarea>
  </div>
  <div style="text-align: center;">
    <button class="btn">Cadastrar</button>
  </div>
</div>
