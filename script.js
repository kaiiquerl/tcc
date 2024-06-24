const modal = document.getElementById('modal_insert');
const tbody = document.querySelector('tbody');
const btnSalvar = document.querySelector('#btnSalvar');

// Variáveis globais que podem ser úteis, como 'itens' e 'id', podem ser definidas conforme necessário

// Event listener para o campo de pesquisa
const search = document.getElementById('pesquisar');

search.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchData();
  }
});

function searchData() {
  const currentUrl = window.location.pathname;
  const searchValue = search.value.trim(); // Trim para remover espaços em branco desnecessários

  if (currentUrl.includes('exibir_admin.php')) {
    window.location = `exibir_admin.php?search=${searchValue}`;
  } else if (currentUrl.includes('exibir.php')) {
    window.location = `exibir.php?search=${searchValue}`;
  }
}

// Abrir o modal de inserção
function openModal() {
  modal.classList.add('active');

  // Definir os valores padrão dos selects para bloco e sala
  document.getElementById('txt_bloco').value = "<?php echo $_SESSION['blocoL']; ?>";
  document.getElementById('txt_sala').value = "<?php echo $_SESSION['labL']; ?>";

  modal.onclick = e => {
    if (e.target.className.indexOf('modal-container') !== -1) {
      modal.classList.remove('active');
    }
  }
}

// Função para fechar o modal (se necessário)
// Removida, pois parece ser redundante

// Função para editar um item
function editItem(index) {
  console.log(index);
  // Adicionar lógica de edição conforme necessário
}

// Função para deletar um item
function deleteItem(index) {
  // Adicionar lógica de deleção conforme necessário
}

// Event listener para o botão de salvar dentro do modal
btnSalvar.addEventListener('click', function() {
  // Adicionar lógica de salvar o item no banco de dados (se necessário)
});
