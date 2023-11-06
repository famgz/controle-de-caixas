// Formatar inputs numéricos
$(function () {
    $(".mask-value").mask("#.##0,00", { reverse: true });
});

// Botão executar busca
const btn_search = document.querySelector('#btn-search');
if (btn_search) {
    btn_search.addEventListener('click', () => {
        document.querySelector('#form-search').submit();
    });
}

// Botão limpar busca
const btn_clean = document.querySelector('#btn-clean');
if (btn_clean) {
    btn_clean.addEventListener('click', () => {
        document.querySelector('#input-search').value = '';
        document.querySelector('#form-search').submit();
    });
}

// Botão resultados por página
const rpp = document.querySelector('#rpp');
if (rpp) {
    rpp.addEventListener('change', () => {
        document.querySelector('#form-select-rpp').submit();
    });
}

// Atribuir ação de clique aos icones de exclusão
const icons_delete = document.querySelectorAll('i.icon-delete.text-danger');
icons_delete.forEach((item) => {
    item.addEventListener('click', (e) => {
        // atribuição do id selecionado ao modal de exclusão
        let id = e.target.dataset.id;
        document.querySelector('#input-delete-id').value = id;
    });
})

// Focar campo de input dentro do modal
$('#add-new-caixa').on('shown.bs.modal', function () {
    $('#nome').focus();
})
