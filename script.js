// Formatar input numérico do campo Saldo Inicial em `Criar Novo Caixa`
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
    })
}

// Botão Resultados por página
const rpp = document.querySelector('#rpp');
if (rpp) {
    rpp.addEventListener('change', () => {
        document.querySelector('#form-select-rpp').submit();
    })
}