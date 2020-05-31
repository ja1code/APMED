<?php

?>
<style>
  @import '../extras/styles/main.css';
  .smoll {
    width: 100% !important;
  }
</style>
<div class="ctn-holder">
<h1>Cadastro funcionário</h1>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <select name="unidade" id="unidade" class="ipt">
        <option value="und" selected>Unidade</option>
        <option value="matriz">Matriz</option>
      </select>
      <input type="text" id="cpf" class="ipt" placeholder="CPF">
      <input type="text" id="nome" class="ipt" placeholder="Nome">
      <input type="text" id="email" class="ipt" placeholder="E-mail">
      <input type="text" id="" class="ipt" placeholder="Fone">
      <input type="text" class="ipt" placeholder="Data de nascimento">
      <div class="row">
        <div class="col-md-6">
          <input type="text" class="ipt smoll" placeholder="CEP">
        </div>
        <div class="col-md-3">
          <input type="text" style="margin-left: 0 !important" class="ipt smoll" placeholder="N°">
        </div>
      </div>
      <input type="text" class="ipt" placeholder="Completos">
    </div>
    <div class="col-md-6">
      <input type="text" class="ipt" placeholder="Função">
      <input type="text" class="ipt" placeholder="CRM (caso explique)">
      <h3><b>Dados de acesso</b></h3>
      <input type="password" class="ipt" placeholder="Senha">
    </div>
  </div>
  <div style="width: 100%; text-align: center">
    <button class="btn">Cadastrar</button>
  </div>
</div>
</div>