const modal = document.getElementById('modal_insert');
const tbody = document.querySelector('tbody');
const btnSalvar = document.querySelector('#btnSalvar');
const btnLimpar = document.getElementById('#btnLimpar');

let itens;
let id;

var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchData();
  }
});

function searchData(bloco, lab) {
  search = document.getElementById('pesquisar');
  const currentUrl = window.location.pathname;

  if (currentUrl.includes('exibir_admin.php')) {
    window.location = 'exibir_admin.php?bloco=' + bloco + '&lab=' + lab + '&search=' + search.value;
    btnLimpar.style.display = 'block';
  } else if (currentUrl.includes('exibir.php')) {
    window.location = 'exibir.php?search=' + search.value;
  }
}

function limpar(bloco, lab) {
  window.location = 'exibir_admin.php?bloco=' + bloco + '&lab=' + lab;
  btnLimpar.style.display = 'none';
}

function openModal() {
  modal.classList.add('active');

  modal.onclick = e => {
    if (e.target.className.indexOf('modal-container') !== -1) {
      modal.classList.remove('active');
    }
  }
}

function openModal2(obj) {
  obj.onclick = e => {
    if (e.target.className.indexOf('modal-container') !== -1) {
      obj.classList.remove('active');
    }
  }
}

function fecharModal2() {
  const modal = document.getElementById('modal_edit');
  modal.classList.remove('active');
}

function editItem(index) {
  console.log(index);
}

function deleteItem(index) {
  itens.splice(index, 1);
  setItensBD();
  loadItens();
}

function openModal2(obj) {
  obj.onclick = e => {
    if (e.target.className.indexOf('modal-container') !== -1) {
      obj.classList.remove('active');
    }
  }
}

function fecharModal2() {
  const modal = document.getElementById('modal_edit');
  modal.classList.remove('active');
}
