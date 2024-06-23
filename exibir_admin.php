<?php
session_start();
$data = "";
$searching = false;  // Nova variável para controle da pesquisa
include_once "conexao.php";

if (!empty($_GET['bloco'])) {
  $bloco_label = @$_GET['bloco'];
  $_SESSION["blocoL"] = $bloco_label;
  $lab_label = @$_GET['lab'];
  $_SESSION["labL"] = $lab_label;
}

if (!$bloco_label) {
  $bloco_label = @$_POST['txt_bloco'];
}
if (!$lab_label) {
  $lab_label = @$_POST['txt_sala'];
}

if (!empty($_GET['search'])) {
  $data = $_GET['search'];
  $searching = true;  // Atualiza a variável de controle quando há uma pesquisa
  $sql = "SELECT * FROM tb_item WHERE (codigo_patrimonio LIKE '%$data%' OR descricao LIKE '%$data%' OR observacao LIKE '%$data%') AND (bloco = '" . $_SESSION["blocoL"] . "' AND sala = '" . $_SESSION["labL"] . "') ORDER BY codigo_patrimonio DESC";
} else {
  $sql = "SELECT * FROM tb_item WHERE bloco = '" . $_SESSION["blocoL"] . "' AND sala = '" . $_SESSION["labL"] . "' ORDER BY codigo_patrimonio DESC";
}

if (isset($_POST['btnSalvar'])) {
  $codigo = $_POST['txt_codigo'];
  $descricao = $_POST['txt_descricao'];
  $bloco = $_POST['txt_bloco'];
  $sala = $_POST['txt_sala'];
  $observacao = $_POST['txt_observacao'];

  $insert = "INSERT INTO tb_item (codigo_patrimonio, descricao, bloco, sala, observacao) VALUES ('$codigo','$descricao','$bloco','$sala','$observacao');";
  $sql1 = "SELECT * FROM tb_item WHERE codigo_patrimonio = '$codigo'";
  $verifica = mysqli_query($conexao, $sql1);
  if (mysqli_num_rows($verifica) == 0) {
    if (mysqli_query($conexao, $insert)) {
      echo "";
    }
  }
}

if (isset($_POST['btnAtualizar'])) {
  $codigo = $_POST['txt_codigo'];
  $descricao = $_POST['txt_descricao'];
  $bloco = $_POST['txt_bloco'];
  $sala = $_POST['txt_sala'];
  $observacao = $_POST['txt_observacao'];

  $update = "UPDATE tb_item SET descricao = '$descricao', bloco = '$bloco', sala = '$sala', observacao = '$observacao' WHERE codigo_patrimonio=$codigo";
  $sql1 = "SELECT * FROM tb_item WHERE codigo_patrimonio = '$codigo'";
  $verifica = mysqli_query($conexao, $sql1);
  if (mysqli_num_rows($verifica) == 1) {
    if (mysqli_query($conexao, $update)) {
      // Recarregar a página após a atualização para manter o contexto
      $redirectUrl = 'exibir_admin.php?bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"];
      if (!empty($_GET['search'])) {
        $redirectUrl .= '&search=' . $_GET['search'];
      }
      header('Location: ' . $redirectUrl);
      exit;
    }
  }
}

if (isset($_GET['excluir'])) {
  $excluir = $_GET['excluir'];
  $sql = "DELETE FROM tb_item WHERE codigo_patrimonio = '$excluir'";
  $consulta = mysqli_query($conexao, $sql);
  // Recarregar a página após a exclusão para manter o contexto
  $redirectUrl = 'exibir_admin.php?bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"];
  if (!empty($_GET['search'])) {
    $redirectUrl .= '&search=' . $_GET['search'];
  }
  header('Location: ' . $redirectUrl);
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exibir_admin</title>
  <link rel="stylesheet" href="exibir.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <style>
    a {
      text-decoration: none;
      padding: 5px !important;
      font-size: 15px !important;
    }

    #btnVoltar {
      display: <?php echo $searching ? 'inline-block' : 'none'; ?>; /* Mostrar o botão se estiver pesquisando */
    }

    .btnCancelar {
      background-color: rgb(226, 57, 57); /* Cor de fundo do botão cancelar */
      color: white; /* Cor do texto do botão cancelar */
      padding: 8px; /* Espaçamento interno do botão */
      border-radius: 5px; /* Borda arredondada do botão */
      border: none; /* Remover borda do botão */
      cursor: pointer; /* Alterar o cursor para pointer */
      width: 100%; /* Ocupar a mesma largura do botão salvar */
      margin: 10px auto; /* Espaçamento automático em cima e embaixo */
    }

    .btnCancelar:hover {
      background-color: darkblue; /* Cor de fundo do botão ao passar o mouse */
    }
  </style>
</head>

<body>
  <div class="top-bar">
    <a href="menu_admin.php" class="scale">Home</a>
    <span id="selected-block">Bloco <?php echo $_SESSION["blocoL"]; ?></span>
    <span id="selected-lab"><?php echo $_SESSION["labL"]; ?></span>
  </div>

  <div class="container">
    <div class="header">
      <span>Cadastro de Itens</span>
      <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar" onkeyup="buscarItem(this.value)">
        <div id="resultado"></div>
        <button onclick="searchData()" class="btns btn-primary" name="btnpesquisar">
          <img src="img/search.svg" class="logos" alt="img search">
        </button>
      </div>
      <button onclick="openModal()" id="new">Incluir</button>
      <button onclick="resetSearch()" id="btnVoltar">Voltar</button>
    </div>

    <div class="crud-body">
      <div class="divTable">
        <table>
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Equipamentos</th>
              <th>Bloco</th>
              <th>Sala</th>
              <th>Observação</th>
              <th>Gerenciar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_assoc($resultado)) {
              echo '
              <tr>
                  <td> ' . $dados["codigo_patrimonio"] . '</td>
                  <td>' . $dados["descricao"] . '</td>
                  <td> ' . $dados["bloco"] . '</td>
                  <td> ' . $dados["sala"] . '</td>
                  <td> ' . $dados["observacao"] . '</td>
                  <td class="btnExcluir">
                      <a href="exibir_admin.php?excluir=' . $dados["codigo_patrimonio"] . '&bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"] . (!empty($data) ? '&search=' . $data : '') . '" id="new">
                           Excluir
                      </a>
                      &nbsp;&nbsp;&nbsp;
                      <a href="exibir_admin.php?alterar=' . $dados["codigo_patrimonio"] . '&bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"] . (!empty($data) ? '&search=' . $data : '') . '" onclick="openModal2()"  id="new">
                          Alterar
                      </a>
                  </td>
              </tr>
            ';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal-container" id="modal_insert">
      <div class="modal">
        <form action="exibir_admin.php" method="post">
          <label for="txt_codigo">Codigo</label>
          <input name="txt_codigo" type="number" required />
          <label for="txt_descricao">Equipamentos</label>
          <input name="txt_descricao" type="text" required />
          <label for="escolhas">Escolha o Bloco:</label>
          <select name="txt_bloco" id="txt_bloco">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select><br>
          <br><label for="escolhas">Escolha o Lab:</label>
          <select name="txt_sala" id="txt_sala">
            <option value="LAB 1">LAB 1</option>
            <option value="LAB 2">LAB 2</option>
            <option value="LAB 3">LAB 3</option>
          </select><br>
          <br><label for="txt_observacao">Observação</label>
          <input name="txt_observacao" type="text" required />
          <button id="btnSalvar" name="btnSalvar" type="submit">Salvar</button>
          <button type="button" class="btnCancelar" onclick="closeModal()">Cancelar</button>
        </form>
      </div>
    </div>

    <?php
    if (!empty($_GET['alterar'])) {
      include_once "conexao.php";
      $codigo = $_GET['alterar'];
      $sql = "SELECT * FROM tb_item WHERE codigo_patrimonio=" . $codigo;
      $consulta = mysqli_query($conexao, $sql);
      $dados = mysqli_fetch_array($consulta);
    ?>
      <div class="modal-container active" id="modal_edit">
        <div class="modal">
          <form action="exibir_admin.php?bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?><?php echo !empty($data) ? '&search=' . $data : ''; ?>" method="post">
            <label for="txt_codigo">Codigo</label>
            <input name="txt_codigo" type="number" required readonly value='<?= $dados['codigo_patrimonio'] ?>' />
            <label for="txt_descricao">Equipamentos</label>
            <input name="txt_descricao" type="text" required value='<?= $dados['descricao'] ?>' />
            <label for="txt_bloco">Escolha o Bloco:</label>
            <select name="txt_bloco" id="txt_bloco">
              <option value="A" <?= ($dados['bloco'] == 'A') ? 'selected' : '' ?>>A</option>
              <option value="B" <?= ($dados['bloco'] == 'B') ? 'selected' : '' ?>>B</option>
              <option value="C" <?= ($dados['bloco'] == 'C') ? 'selected' : '' ?>>C</option>
            </select><br>
            <br><label for="txt_sala">Escolha o Lab:</label>
            <select name="txt_sala" id="txt_sala">
              <option value="LAB 1" <?= ($dados['sala'] == 'LAB 1') ? 'selected' : '' ?>>LAB 1</option>
              <option value="LAB 2" <?= ($dados['sala'] == 'LAB 2') ? 'selected' : '' ?>>LAB 2</option>
              <option value="LAB 3" <?= ($dados['sala'] == 'LAB 3') ? 'selected' : '' ?>>LAB 3</option>
            </select><br>
            <br><label for="txt_observacao">Observação</label>
            <input name="txt_observacao" type="text" required value='<?= $dados['observacao'] ?>' />
            <button id="btnAtualizar" name="btnAtualizar" type="submit">Atualizar</button>
            <button type="button" class="btnCancelar" onclick="closeModal()">Cancelar</button>
          </form>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <script>
    function buscarItem(valor) {
      // Lógica de busca em tempo real (AJAX)
    }

    function searchData() {
      let search = document.getElementById('pesquisar').value;
      window.location.href = 'exibir_admin.php?search=' + search + '&bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?>';
    }

    function resetSearch() {
      window.location.href = 'exibir_admin.php?bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?>';
    }

    function openModal() {
      document.getElementById('modal_insert').classList.add('active');
    }

    function openModal2() {
      document.getElementById('modal_edit').classList.add('active');
    }

    function closeModal() {
      document.getElementById('modal_insert').classList.remove('active');
      document.getElementById('modal_edit').classList.remove('active');
      // Redirecionar para a página principal ao fechar o modal de alteração
      window.location.href = 'exibir_admin.php?bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?><?php echo !empty($data) ? '&search=' . $data : ''; ?>';
    }
  </script>
</body>

</html>
