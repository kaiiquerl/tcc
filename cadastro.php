<?php
include_once "conexao.php";

if (isset($_POST['btn_login'])) {
    $usuarioP = $_POST["txt_usuario"];
    $senhaP = $_POST["txt_senha"];

    if (empty($usuarioP) || empty($senhaP)) {
        echo "Por favor, preencha todos os campos.";
    } else {
  
        $sql = "SELECT * FROM tb_login WHERE usuario = '$usuarioP' AND senha = '$senhaP';";
        $consulta = mysqli_query($conexao, $sql);
        $resultado = mysqli_num_rows($consulta);

        if ($resultado > 0) {
            echo "acesso liberado";
            session_start();
            $_SESSION['usuario'] = $usuarioP;
            $_SESSION['senha'] = $senhaP;
            header("Location: menu.php");
        } else {
            echo "acesso negado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <div class="left-login">

            <h1>TORNE-SE UM MEMBRO!!!</h1>
            <img src="img/img_cadastro.svg" class="img_cadastro" alt="cadastro animação">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1> FAÇA SEU CADASTRO</h1>
                <form action="login.php" method="post">
                    <div class="textfield">
                        <label for="usuario">Crie Seu Usuário</label>
                        <input type="text" name="txt_usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <label for="senha">Defina Sua Senha</label>
                        <input type="password" name="txt_senha" placeholder="Senha">
                    </div>
                    <div class="btn2">
                        <button class="btn-cadastrar2" name="btn_cadastrar">Cadastrar</button>
                        <a href="login.php" class="btn-cadastrar2" >Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>