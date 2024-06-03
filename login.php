 <?php
    include_once 'conexao.php';

    if (isset($_POST['btn_login'])) {
        $usuarioP = $_POST["txt_usuario"];
        $senhaP = $_POST["txt_senha"];

        $sql = "SELECT * FROM tb_login WHERE usuario = '$usuarioP' AND senha = '$senhaP'";
        $consulta = mysqli_query($conexao, $sql);
        $resultado = mysqli_num_rows($consulta);
        $usuario = '';
        $tipo = '';

        if ($resultado > 0) {
            while ($row = mysqli_fetch_assoc($consulta)) {
                $usuario = $row['usuario'];
                $tipo    = $row['tipo'];
            }
            echo "Acesso liberado!";
            session_start();
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
            echo "Acesso negado!";
        }
    } elseif (isset($_POST['btn_cadastrar'])) {
        $usuario = $_POST['txt_usuario'];
        $senha   = $_POST['txt_senha'];

        $sql = "INSERT INTO tb_login (usuario, senha) VALUES ('$usuario', '$senha')";

        try {
            $consulta = mysqli_query($conexao, $sql);
            if ($consulta > 0) {
                header('Location: login.php');
            }
        } catch (Exception $e) {
            echo 'O usuário não pode ser cadastrado!';
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

             <h1>Faça login<br>E entre para o nosso time</h1>
             <img src="img/box.svg" class="img_box" alt="box animação">
         </div>
         <div class="right-login">
             <div class="card-login">
                 <h1>Junte-se a nós !!!
                     <br>acesse sua conta
                     <br>ou cadastre-se.
                 </h1>

                 <form action="login.php" method="post" enctype="multipart/form-data">
                     <div class="textfield">
                         <label for="usuario">Usuário</label>
                         <input type="text" name="txt_usuario" placeholder="Usuário">
                     </div>

                     <div class="textfield">
                         <label for="senha">Senha</label>
                         <input type="password" name="txt_senha" placeholder="Senha">
                     </div>

                     <div class="btn">
                         <button class="btn-login" name="btn_login">Login</button><br>
                         <a href="cadastro.php" class="btn-cadastrar" name="btn_cadastrar" style="color: #2b134b; text-decoration: none">Cadastrar</a>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </body>

 <script>
     function validarLogin() {
         var usuario = document.getElementById('txt_usuario').value;
         var senha = document.getElementById('txt_senha').value;

         if (usuario === '' || senha === '') {
             document.getElementById('erro-login').innerText = 'Por favor, preencha todos os campos.';
             document.getElementById('erro-login').style.display = 'block';
             return false;
         } else {
             // Aqui você pode adicionar sua lógica de verificação no PHP, se preferir
             // Por exemplo, enviar uma solicitação AJAX para verificar os dados no servidor
             // E exibir a mensagem de erro de acordo com a resposta do servidor
             // Como isso é um exemplo, vou apenas exibir uma mensagem de erro fixa para demonstração
             document.getElementById('erro-login').innerText = 'Usuário ou senha incorretos.';
             document.getElementById('erro-login').style.display = 'block';
             return false;
         }
     }
 </script>


 </html>