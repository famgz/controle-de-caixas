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
        document.querySelector('#data-ini').value = '';
        document.querySelector('#data-fin').value = '';
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

// Converter float para monetario
function float_to_currency(value) {
    return parseFloat(value)
    .toLocaleString(
        'pt-BR',
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }
    );
}


// Obter dados do lancamento para preencher modal de edicao
function modal_edit(id) {
    if (!id) {
        alert('ID invalido');
        return false;
    }

    let ajax = new XMLHttpRequest();
    ajax.open('GET', `ajax.php?id=${id}&action=edit_modal`);
    ajax.setRequestHeader('Content-type', 'application/json');
    ajax.send();

    
    ajax.onreadystatechange = () => {
        let res = ''
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                res = JSON.parse(ajax.responseText);
                if (res === 'erro') {
                    alert('Erro. Algo saiu errado');
                    return false;
                }
            }
            else {
                console.log(ajax.status);
            }
        }
        if (!res) { return };

        // console.log(res);

        modal = document.querySelector('#modal-edit-lancamento');
        modal.querySelector('#edit_id_caixa').value = res.id_caixa;
        modal.querySelector('#edit_id_lancamento').value = res.id;
        modal.querySelector('#edit_discriminacao_movimento').value = res.discriminacao_movimento;
        modal.querySelector('#edit_data_movimento').value = res.data_movimento.split(' ')[0];
        modal.querySelector('#edit_valor_movimento').value = float_to_currency(res.valor_movimento);
        modal.querySelector('#edit_tipo_movimento').value = res.movimento;
    }
}