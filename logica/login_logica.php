<?php

/**
 * Lógica para realizar a autenticação de usuários
*/

include('config.php'); // Importa o arquivo de configuração

function checarPermissoes ($id) { // Função que busca na tabela Perfil qual é a desc do usuário que está realizando login
  global $db; // Chama a variavel externa $db
  $sql = "SELECT * FROM Perfil WHERE idPerfil = '$id'"; // Seleciona tudo da tabela perfil, onde o id é X
  $acao = $db->query($sql); // Realiza a query
  if ($acao == true) { // Caso a query seja verdadeira:
    $dados = $acao->fetch_object(); // Pegar o objeto resultado da query
    return $dados->DePerfil; // retornar a descrição do perfil
  } else {
    return 0;
  }
}

$data = file_get_contents('php://input');
$data = json_decode($data);
$cpf = $data->cpf; // Pega do corpo de uma requisição POST o valor "cpf"
$senha = $data->senha; // pega o valor "senha"

$sql = "SELECT * FROM Usuario WHERE loginUsuario = '$cpf'"; // Procura pelo usuário com um cpf x na tabela Usuarios
$acao = $db->query($sql);
if ($acao == true) {
  $num_linhas = $acao->num_rows; // Pega o número de resultados retornados da query
  if ($num_linhas == 0) { // Caso o número de resultados seja 0
    echo "Usuário não encontrado";
  } else if ($num_linhas > 1) { // Caso o n° de resultados seja maior que 1
    echo "Usuário duplicado";
  } else { // Caso haja apenas um usuário (usuário correto)
    $dados = $acao->fetch_object(); // Pega o objeto do resultado encontrado
    if ($dados->senhaUsuario == $senha) { // Caso a senha fornecidada no POST seja a mesma senha registrada no banco de dados
      echo checarPermissoes($dados->Perfil_idPerfil); // Dá como resultado o retorno da função `checarPermissoes`
    } else { // Caso contrário
      echo "Senha incorreta";
    }

  }
} else { // Caso a conexão com o banco de dados dê errado
  echo "Erro ao se conectar no banco de dados";
}




?>