<?php

?>
<style>
  @import '../extras/styles/main.css';
  .smoll {
    width: 100% !important;
  }
</style>
<div class="ctn-holder">
<h1>Editar paciente</h1>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <input type="text" id="cpf" class="ipt" placeholder="CPF">
      <input type="text" id="nome" class="ipt" placeholder="Nome">
      <input type="text" id="email" class="ipt" placeholder="E-mail">
      <input type="text" id="tel" class="ipt" placeholder="Fone">
      <input type="text" id="nasc" class="ipt" placeholder="Data de nascimento">
      <div class="row">
        <div class="col-md-6">
          <input type="text" id="end" class="ipt smoll" placeholder="CEP">
        </div>
        <div class="col-md-3">
          <input type="text" style="margin-left: 0 !important" class="ipt smoll" placeholder="N°">
        </div>
      </div>
      <input type="text" class="ipt" placeholder="Complementos">
    </div>
    <div class="col-md-6">
      <h3><b>Dados de acesso</b></h3>
      <input type="password" id="senha" class="ipt" placeholder="Senha">
    </div>
  </div>
  <div style="width: 100%; text-align: center">
    <button class="btn" onclick="send()">Cadastrar</button>
  </div>
</div>
</div>
<script src="bin/vendor/jquery/jquery.min.js"></script>
<script src="bin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  var id
  axios.get(`/logica/info_logica.php?id=${window.location.search.split('=')[2]}&tipo=funcionario`)
    .then(r => {
      document.getElementById('cpf').value = r.data.cpf
      document.getElementById('nome').value = r.data.nome
      document.getElementById('nasc').value = r.data.nasc
      document.getElementById('end').value = r.data.end
      document.getElementById('tel').value = r.data.tel
      document.getElementById('email').value = r.data.email
      id = r.data.id
    })
    .catch(e => {
      console.log(e)
      alert("Não foi possível requisitar os dados, tente novamente")
    })

  if (window.location.search.split('=')[1] == 'adc-funcionario') {
    $('#cpf').mask('000.000.000-00', {reverse: true});

    $('#tel').mask('(00) 00000-0000');

    $('#nasc').mask('00/00/0000', {reverse: true});

    $('#end').mask('00000-000', {reverse: true});
  }

  function send() {
    let sendobj = {
      tipo: 'paciente',
      cpf: document.getElementById('cpf').value,
      nome: document.getElementById('nome').value,
      email: document.getElementById('email').value,
      tel: document.getElementById('tel').value,
      nasc: document.getElementById('nasc').value,
      end: document.getElementById('end').value,
      senha: document.getElementById('senha').value
    }

    axios.post('/logica/editar_logica.php', sendobj)
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