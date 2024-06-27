<?php
include_once 'conexao.php';
session_start();

if (isset($_POST['btn_login'])) {
    $usuarioP = $_POST["txt_usuario"];
    $senhaP = $_POST["txt_senha"];

    if (empty($usuarioP) || empty($senhaP)) {
        $_SESSION['login_erro'] = "Por favor, preencha todos os campos.";
        header('Location: login.php');
        exit();
    }

    $sql = "SELECT * FROM tb_login WHERE usuario = ? AND senha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ss', $usuarioP, $senhaP);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = '';
    $tipo = '';

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $usuario = $row['usuario'];
            $tipo = $row['tipo'];
        }
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo'] = $tipo;

        if ($tipo == 'A') {
            header("Location: menu_admin.php");
        } else if ($tipo == 'U') {
            header('Location: menu.php');
        } else {
            echo "Acesso negado!";
        }
    } else {
        $_SESSION['login_erro'] = "Usuário ou senha incorretos.";
        header('Location: login.php');
        exit();
    }
} elseif (isset($_POST['btn_cadastrar'])) {
    $usuario = $_POST['txt_usuario'];
    $senha = $_POST['txt_senha'];

    if (empty($usuario) || empty($senha)) {
        $_SESSION['cadastro_erro'] = "Por favor, preencha todos os campos.";
        header('Location: cadastro.php');
        exit();
    }

    $sql = "INSERT INTO tb_login (usuario, senha) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ss', $usuario, $senha);

    try {
        $consulta = $stmt->execute();
        if ($consulta) {
            header('Location: login.php');
        }
    } catch (Exception $e) {
        $_SESSION['cadastro_erro'] = 'O usuário não pode ser cadastrado!';
        header('Location: cadastro.php');
        exit();
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
            <h1>ENTRE AGORA<br>E FAÇA PARTE DA NOSSA COMUNIDADE</h1>
            <img src="img/img_login.svg" class="img_login" alt="login animação">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>ACESSE SUA CONTA<br>OU CADASTRE-SE.</h1>
                <div id="erro-login" class="erro" style="display: none;"></div>
                <form action="login.php" method="post" onsubmit="return validarLogin()">
                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input type="text" id="txt_usuario" name="txt_usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" id="txt_senha" name="txt_senha" placeholder="Senha">
                    </div>
                    <div class="btn2">
                        <button class="btn-login" name="btn_login">Login</button><br>
                        <a href="cadastro.php" class="btn-cadastrar" style="color: #ffff; text-decoration: none">Cadastrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function validarLogin() {
            var usuario = document.getElementById('txt_usuario').value;
            var senha = document.getElementById('txt_senha').value;
            var erroLogin = document.getElementById('erro-login');

            if (usuario === '' || senha === '') {
                erroLogin.innerText = 'Por favor, preencha todos os campos.';
                erroLogin.style.display = 'block';
                return false;
            }
            return true;
        }

        <?php
        if (isset($_SESSION['login_erro'])) {
            echo "document.getElementById('erro-login').innerText = '".$_SESSION['login_erro']."';";
            echo "document.getElementById('erro-login').style.display = 'block';";
            unset($_SESSION['login_erro']);
        }
        ?>
    </script>
</body>
</html>
