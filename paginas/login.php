<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../extras/styles/main.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <title>APMED - Login</title>
</head>
<body>
  <div class="flex-container">
    <h1 class="logo">APMED</h1>
    <input type="text" id="cpf" class="ipt" placeholder="CPF">
    <input type="password" id="senha" class="ipt" placeholder="Senha">
    <button class="btn" onclick="login()">Entrar</button>
    <div class="login-extras">
      <a href="">Esqueci minha senha</a>
      <p>Não possui uma conta? <a href="">Cadstre-se agora</a></p>
    </div>
  </div>
  <script>
    $(document).ready(() => {
      console.log('a')
      $('#cpf').mask('000.000.000-00', {reverse: true});
    })
    function login() {
      let cpf = document.getElementById('cpf').value
      let senha = document.getElementById('senha').value
      console.log(cpf, senha)
      if (cpf.length > 0 && senha.length > 0) {
        if (cpf.length == 14) {
          axios.post(window.location.origin + "/logica/login_logica.php", {cpf, senha})
          .then(r => {
            if (r.data != "Usuário não encontrado") {
              localStorage.setItem('type', JSON.stringify(r.data))
              window.location.href = window.location.origin +'/paginas/dashboard.php'
            } else {
              alert(r.data.tipo)
            }
          })
          .catch(e => {
            alert('Ocorreu um erro ao tentar processar sua solicitação. Tente novamente!')
          })
        } else {
          alert("Digite um cpf válido!")
        }
      } else {
        alert("Por favor, preencha os campos corretamente")
      }
    }
  </script>
</body>
</html>