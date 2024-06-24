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
      $redirectUrl = 'exibir.php?bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"];
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
  $redirectUrl = 'exibir.php?bloco=' . $_SESSION["blocoL"] . '&lab=' . $_SESSION["labL"];
  if (!empty($_GET['search'])) {
    $redirectUrl .= '&search=' . $_GET['search'];
  }
  header('Location: ' . $redirectUrl);
  exit;
}

// Adiciona as variáveis de controle
$alterar_codigo = "";
$alterar_descricao = "";
$alterar_observacao = "";

// Verifica se existe a ação de alteração
if (isset($_GET['alterar'])) {
  $alterar_codigo = $_GET['alterar'];
  $sql2 = "SELECT * FROM tb_item WHERE codigo_patrimonio = '$alterar_codigo'";
  $result = mysqli_query($conexao, $sql2);
  if ($row = mysqli_fetch_assoc($result)) {
    $alterar_descricao = $row['descricao'];
    $alterar_observacao = $row['observacao'];
  }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exibir</title>
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

    .manage-buttons a {
      margin-right: 10px; /* Espaçamento entre os botões */
    }

    .manage-buttons a:last-child {
      margin-right: 0; /* Remove o espaçamento no último botão */
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
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar" onkeyup="handleKeyUp(event)">
        <div id="resultado"></div>
        <button onclick="searchData()" class="btns btn-primary" name="btnpesquisar">
          <img src="img/search.svg" class="logos" alt="img search">
        </button>
      </div>
      <button onclick="resetSearch()" id="btnVoltar">Voltar</button> 
    </div>

    <div class="crud-body">
      <div class="divTable">
      <table class="table-center">
    <thead>
        <tr>
            <th>Código</th>
            <th>Equipamento</th>
            <th>Bloco</th>
            <th>Sala</th>
            <th>Observação</th>
           
        </tr>
    </thead>
    <tbody>
    <?php
$resultado = mysqli_query($conexao, $sql);
while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<tr>';
    echo '<td>' . $dados["codigo_patrimonio"] . '</td>';
    echo '<td>' . $dados["descricao"] . '</td>';
    echo '<td>' . $dados["bloco"] . '</td>';
    echo '<td>' . $dados["sala"] . '</td>';
    echo '<td>' . $dados["observacao"] . '</td>';
    echo '</td>';
    echo '</tr>';
}
?>

    </tbody>
</table>

      </div>
    </div>

    <div class="modal-container" id="modal_insert">
  <div class="modal">
    <form action="exibir.php" method="post">
      <label for="txt_codigo">Código</label>
      <input name="txt_codigo" type="number" required />
      <label for="txt_descricao">Equipamento</label>
      <input name="txt_descricao" type="text" required />
      <label for="txt_bloco">Escolha o Bloco:</label>
      <select name="txt_bloco" id="txt_bloco">
        <option value="A" <?= ($_SESSION['blocoL'] == 'A') ? 'selected' : '' ?>>A</option>
        <option value="B" <?= ($_SESSION['blocoL'] == 'B') ? 'selected' : '' ?>>B</option>
        <option value="C" <?= ($_SESSION['blocoL'] == 'C') ? 'selected' : '' ?>>C</option>
      </select><br>
      <br><label for="txt_sala">Escolha o Lab:</label>
      <select name="txt_sala" id="txt_sala">
        <option value="LAB 1" <?= ($_SESSION['labL'] == 'LAB 1') ? 'selected' : '' ?>>LAB 1</option>
        <option value="LAB 2" <?= ($_SESSION['labL'] == 'LAB 2') ? 'selected' : '' ?>>LAB 2</option>
        <option value="LAB 3" <?= ($_SESSION['labL'] == 'LAB 3') ? 'selected' : '' ?>>LAB 3</option>
      </select><br><br>
      <label for="txt_observacao">Observação</label>
      <input name="txt_observacao" type="text" />
      <button type="submit" class="btnSalvar" name="btnSalvar">Salvar</button>
      <button type="button" class="btnCancelar" onclick="closeModal()">Cancelar</button>
    </form>
  </div>
</div>

    <div class="modal-container" id="modal_update">
      <div class="modal">
        <form action="exibir.php" method="post">
          <label for="txt_codigo">Código</label>
          <input name="txt_codigo" id="txt_codigo" type="number" readonly />
          <label for="txt_descricao">Equipamento</label>
          <input name="txt_descricao" id="txt_descricao" type="text" required />
          <label for="txt_bloco">Bloco</label>
          <input name="txt_bloco" id="txt_bloco" type="text" value="<?php echo $_SESSION["blocoL"]; ?>" required readonly />
          <label for="txt_sala">Lab</label>
          <input name="txt_sala" id="txt_sala" type="text" value="<?php echo $_SESSION["labL"]; ?>" required readonly />
          <label for="txt_observacao">Observação</label>
          <input name="txt_observacao" id="txt_observacao" type="text" />
          <button type="submit" class="btnSalvar" name="btnAtualizar">Salvar</button>
          <button type="button" class="btnCancelar" onclick="closeUpdateModal()">Cancelar</button>
        </form>
      </div>
    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    // Verifica se há parâmetros para alterar na URL
    const urlParams = new URLSearchParams(window.location.search);
    const alterar = urlParams.get('alterar');

    if (alterar) {
      // Pega os dados passados na URL
      const descricao = "<?php echo addslashes($alterar_descricao); ?>";
      const observacao = "<?php echo addslashes($alterar_observacao); ?>";

      // Chama a função para abrir o modal de atualização
      openUpdateModal(alterar, descricao, observacao);
    }
  });

  function handleKeyUp(event) {
    if (event.key === 'Enter') {
      searchData();
    }
  }

  function searchData() {
    var search = document.getElementById('pesquisar').value;
    window.location.href = 'exibir.php?search=' + search + '&bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?>';
  }

  function resetSearch() {
    window.location.href = 'exibir.php?bloco=<?php echo $_SESSION["blocoL"]; ?>&lab=<?php echo $_SESSION["labL"]; ?>';
  }

  function openModal() {
    document.getElementById('modal_insert').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('modal_insert').style.display = 'none';
  }

  function openUpdateModal(codigo, descricao, observacao) {
    document.getElementById('txt_codigo').value = codigo;
    document.getElementById('txt_descricao').value = descricao;
    document.getElementById('txt_observacao').value = observacao;
    document.getElementById('modal_update').style.display = 'flex';
  }

  function closeUpdateModal() {
    document.getElementById('modal_update').style.display = 'none';
    clearURLParams(); // Limpar os parâmetros da URL
  }

  function clearURLParams() {
    const url = new URL(window.location);
    url.searchParams.delete('alterar');
    url.searchParams.delete('descricao');
    url.searchParams.delete('observacao');
    history.replaceState(null, '', url.toString());
  }
</script>


</body>

</html>
