// Formatar inputs numéricos
$(() => {
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

// Detalhes do Caixa, atribuir eventos aos botoes de filtro data
const form_filter_date = document.querySelector('#form-filter-date');
// botao submit
const btn_filter_date = document.querySelector('#btn-filter-date');
if (btn_filter_date) {
    btn_filter_date.addEventListener('click', () => {
        form_filter_date.submit();
    })
}
// botao reset
const btn_filter_date_reset = document.querySelector('#btn-filter-date-reset');
if (btn_filter_date_reset) {
    btn_filter_date_reset.addEventListener('click', () => {
        document.querySelector('#data-ini').value = "";
        document.querySelector('#data-fin').value = "";
        form_filter_date.submit();
    })
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

// Aplicar ID do botão Excluir Caixa ao value do input modal input-delete-id antes de enviar para delete-caixa-action.php
document.addEventListener('DOMContentLoaded', function () {
    // Get all elements with the data-bs-target attribute
    let modalTriggers = document.querySelectorAll('[data-bs-target="#delete-caixa"]');

    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            // Get the data-id attribute from the clicked button
            let id = trigger.getAttribute('data-id');

            // Set the value of the hidden input field in the modal
            let modal = document.getElementById('input-delete-id');
            if (modal) {
                modal.value = id;
            }
        });
    });
});

// Focar campo de input dentro do modal
$('#add-new-caixa').on('shown.bs.modal', function () {
    $('#nome').focus();
})
