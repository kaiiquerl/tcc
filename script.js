const modal = document.getElementById('modal_insert');
const tbody = document.querySelector('tbody');
const btnSalvar = document.querySelector('#btnSalvar');

let itens;
let id;

var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    searchData();
  }
});

function searchData() {
  search = document.getElementById('pesquisar');
  const currentUrl = window.location.pathname;

  if (currentUrl.includes('exibir_admin.php')) {
    window.location = 'exibir_admin.php?search=' + search.value;
  } else if (currentUrl.includes('exibir.php')) {
    window.location = 'exibir.php?search=' + search.value;
  }
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
