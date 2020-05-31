<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>APMED</title>

  <!-- Bootstrap core CSS -->
  <link href="bin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="bin/css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="../extras/styles/dashboard.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-blue border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><h1><b>APMED</b></h1></div>
      <div class="username"><a id="permission"></a></div>
      <div class="list-group list-group-flush">
      <?php
        if (isset($_COOKIE['type'])) {
          if ($_COOKIE['type'] === 'Medico') {
            echo '<a href="?page=pacientes" class="list-group-item list-group-item-action bg-blue">Pacientes</a>';
            echo '<a href="?page=relatorios" class="list-group-item list-group-item-action bg-blue">Relatórios</a>';
            echo '<a href="?page=consultas" class="list-group-item list-group-item-action bg-blue">Consultas</a>';
          } elseif ($_COOKIE['type'] === 'Funcionario' && !isset($_COOKIE['admin'])) {
            echo '<a href="?page=consultas" class="list-group-item list-group-item-action bg-blue">Consultas</a>';
            echo '<a href="?page=pacientes" class="list-group-item list-group-item-action bg-blue">Pacientes</a>';
            echo '<a href="?page=pagamentos" class="list-group-item list-group-item-action bg-blue">Pagamentos</a>';
          } elseif ($_COOKIE['type'] === 'Funcionario' && isset($_COOKIE['admin'])) {
            echo '<a href="?page=funcionarios" class="list-group-item list-group-item-action bg-blue">Funcionários</a>';
          }
        }
      ?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-blue border-bottom">
        <a id="menu-toggle"><span class="iconify" data-inline="false" data-icon="ant-design:menu-outlined" style="font-size: 36px;"></span></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 hor-align">
            <li class="nav-item usr-img" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
              <img src="../extras/images/user_icon.png" alt="icon">
              <h4 id="username"></h4>
            </li>
            <li class="nav-item pencil">
              <span class="iconify" data-inline="false" data-icon="bx:bx-pencil" style="font-size: 24px;"></span>
            </li>
            <li class="nav-item dropdown exit">
              <span class="iconify" data-inline="false" data-icon="bx:bx-exit" style="font-size: 24px;"></span>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <?php 
          session_start();
          switch(@$_REQUEST['page']) {
            case 'funcionarios':
              include('./funcionarios.php');
            break;
            case 'adc-funcionario':
              include('./adc-funcionario.php');
            break;
            case 'edt-funcionario':
              include('./edt-funcionario.php');
            break;
            case 'medicos':
              include('./medicos.php');
            break;
            case 'adc-medico':
              include('./adc-medico.php');
            break;
            case 'edt-medico':
              include('./edt-medico.php');
            break;
            case 'pacientes':
              include('./paciente.php');
            break;
            case 'adc-paciente':
              include('./adc-paciente.php');
            break;
            case 'edt-paciente':
              include('./edt-paciente.php');
            break;
            case 'consultas':
              include('./consulta.php');
            break;
            case 'adc-consulta':
              include('./adc-consulta.php');
            break;
            case 'edt-consulta':
              include('./edt-consulta.php');
            break;
            case 'pagamentos':
              include('./pagamentos.php');
            break;
            case 'relatorios':
              include('./relatorio.php');
            break;
            case 'ver-relatorio':
              include('./edt-relatorio.php');
            break;
            default:
              if (!isset($_COOKIE['admin'])) {
                include("./home-{$_COOKIE['type']}.php");
              } elseif ($_COOKIE['type'] === 'Funcionario' && isset($_COOKIE['admin'])) {
                include("./home-admin.php");
              }
            break;
          }
        ?>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="bin/vendor/jquery/jquery.min.js"></script>
  <script src="bin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    let userdata = JSON.parse(localStorage.getItem('type'))
    tipo = userdata.tipo == "Admin" ? "Funcionario" : userdata.tipo
    axios.get(`/logica/dados_usuarios.php?id=${userdata.id}`)
      .then(r => {
        document.getElementById('permission').innerText = tipo
        document.getElementById('username').innerText = r.data[`nome${userdata.tipo}`]
        if (document.getElementById('welcome-header')) {
          document.getElementById('welcome-header').innerText = `Seja bem vindo ${r.data[`nome${userdata.tipo}`]}`
        }
      })
      .catch(e => {
        console.log(e)
        // alert('Não foi possível concluir sua requisição, tente novamente')
      })
  </script>

</body>

</html>
