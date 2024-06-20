<?php
session_start();
$data = "";
include_once "conexao.php";

if (!empty($_GET['bloco'])) {
  $bloco_label = @$_GET['bloco'];
  $_SESSION["blocoL"] = $bloco_label;
  $lab_label = @$_GET['lab'];
  $_SESSION["labL"] = $lab_label;
  echo '' . $_SESSION[""];
}



if (!$bloco_label) {
  $bloco_label = @$_POST['txt_bloco'];
}
if (!$lab_label) {
  $lab_label = @$_POST['txt_sala'];
}

if (!empty($_GET['search'])) {
  $data = $_GET['search'];
  $sql = "SELECT * FROM tb_item WHERE (codigo_patrimonio LIKE '%$data%' or descricao LIKE '%$data%' or observacao LIKE '%$data%') AND (bloco = '" . $_SESSION["blocoL"] . "' AND sala = '" . $_SESSION["labL"] . "') ORDER BY codigo_patrimonio DESC";
} else {
  $sql = "SELECT * FROM tb_item ORDER BY codigo_patrimonio WHERE bloco = '" . $_SESSION["blocoL"] . "' AND sala = '" . $_SESSION["labL"] . "' DESC";
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
      echo "";
    }
  }
}

if (isset($_GET['excluir'])) {
  $excluir = $_GET['excluir'];
  $sql = "DELETE FROM tb_item WHERE codigo_patrimonio = '$excluir'";
  $consulta = mysqli_query($conexao, $sql);
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
  </style>
</head>

<body>
  <div class="top-bar">
    <a href="menu_admin.php" class="scale">Home</a>
    <span id="selected-block">Bloco <?php echo $bloco_label; ?></span>
    <span id="selected-lab"><?php echo $lab_label; ?></span>
  </div>

  <div class="container">

  <div class="header">
      <span>Cadastro de Itens</span>
      <div class="box-search">

        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btns btn-primary" name="btnpesquisar">
        <img src="img/search.svg" class="logos" alt="img search">
          </svg>
        </button>

      </div>

      <button onclick="openModal()" id="new">Incluir</button>
    </div>

    <div class="crud-body">
      <table>
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Descrição</th>
            <th>Bloco</th>
            <th>Sala</th>
            <th>Observação</th>
            <th>Gerenciar</th>
          </tr>
          <?php
          if ($data == "") {
            $sql = "SELECT * FROM tb_item WHERE bloco = '$bloco_label' AND sala = '$lab_label' ORDER BY codigo_patrimonio;";
          }

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
                             <a href="exibir_admin.php?excluir=' . $dados["codigo_patrimonio"] . '&bloco=' . $bloco_label . '&lab=' . $lab_label . '" id="new">
                                  Excluir
                             </a>
                             &nbsp;&nbsp;&nbsp;
                             <a href="exibir_admin.php?alterar=' . $dados["codigo_patrimonio"] . '&bloco=' . $bloco_label . '&lab=' . $lab_label . ' " onclick="openModal2()"  id="new">
                                 Alterar
                             </a>
                         </td>
                     <tr>
                     ';
          }
          ?>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>

    <div class="modal-container" id="modal_insert">
      <div class="modal">

        <form action="exibir_admin.php" method="post">
          <label for="txt_codigo">Codigo</label>
          <input name="txt_codigo" type="number" required />

          <label for="txt_descricao">Descição</label>
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
        </form>
      </div>

    </div>


    <?php
    if (isset($_GET['alterar'])) {
      $alterar = $_GET['alterar'];
      $sql = "SELECT * FROM tb_item WHERE codigo_patrimonio =  '$alterar';";
      $consulta = mysqli_query($conexao, $sql);
      $dados = mysqli_fetch_array($consulta);
      ?>

      <div class="modal-container active" id="modal_edit" onclick="openModal2(this)">
        <div class="modal">

          <form action="exibir_admin.php" method="post">
            <label for="txt_codigo">Codigo</label>
            <input name="txt_codigo" type="number" required value='<?= $dados['codigo_patrimonio'] ?>' />

            <label for="txt_descricao">Descrição</label>
            <input name="txt_descricao" type="text" required value='<?= $dados["descricao"] ?>' />

            <label for="escolhas">Escolha o Bloco:</label>
            <select name="txt_bloco" id="txt_bloco">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select><br>
            <?= $dados["bloco"] ?>' />

            <br><label for="escolhas">Escolha o Lab:</label>
            <select name="txt_sala" id="txt_sala">
              <option value="LAB 1">LAB 1</option>
              <option value="LAB 2">LAB 2</option>
              <option value="LAB 3">LAB 3</option>
            </select><br>
            <?= $dados["sala"] ?>

            <br><label for="txt_observacao">Observação</label>
            <input name="txt_observacao" type="text" required value='<?= $dados["observacao"] ?>' />

            <button type="submit" name="btnAtualizar">Atualizar</button>
            <button type="button" onclick="fecharModal2()">Cancelar</button>
          </form>

        </div>
      </div>
      <?php
    }
    ?>
  </div>
  <script src="script.js"></script>
</body>

</html>