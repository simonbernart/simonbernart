

<?php
include_once 'conexaodb.php'

//incluindo a conexão do banco de dados
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

<h1>Tela de Cadastro</h1>
<?php


//recebe os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verifica se usuario clicou no botão de castro
if (!empty($dados['CadUsuario'])) {

   // var_dump($dados);



    $empty_input = false;
// não permite cadastro em branco
    $dados = array_map('trim', $dados);

    //não permite cadastrar com espaço em branco no inicio
    if(in_array("", $dados)){
        $empty_input = true;

        echo "<p style='color:red;'> ERRO: Necessario preencher todos os campos! </p>";
        // faz validação se o e-mail segue padrão
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {

        $empty_input = true;
        echo "<p style='color:red;'> ERRO: Necessario preencher com e-mail válido!</p>";
    }
// faz a persistencia dos dados no banco
    if (!$empty_input){

        $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email) ";

        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $cad_usuario->execute ();
        if ($cad_usuario->rowCount()){
        echo "<p style='color:green;'> Usuario cadastrado com sucesso! </p>";
        unset($dados);
        }else{
            echo "<p style='color:red;'> Não foi possivel realizar o cadastro! </p>";

        }
    }

}
?>
 <h3>Faça o seu cadastro</h3>
  <form name="cadastro_user" method="POST" action="">

      <label>Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php
      // mantem o texto na caixa caso apresente erro no cadastro
      if (isset($dados ['nome'])) {

        echo $dados['nome'];

      }     
      ?>" > <br/> <br/>
      
      <label>E-mail:</label>
      <input type="email" name="email" id="email" placeholder="E-mail" value="<?php
      // mantem o texto na caixa caso apresente erro no cadastro
      if (isset($dados ['email'])) {

        echo $dados['email'];

      }     
      ?>" > <br/> <br/>

    <input type="submit" value="Cadastrar" name="CadUsuario">
  </form>
</body>
</html>