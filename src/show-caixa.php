<?php
include_once "header.php";
include "show-caixa-action.php";
?>

<div class="container border round mt-3 p-3 shadow bg-light">
    <div class="row">
        <div class="col">
            <div class="row">
                <h3>
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    Detalhes do Caixa
                </h3>
            </div>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
            <button class="btn btn-sm btn-light">
                <a href="index.php">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </button>
            <small>Controle de Caixas</small>
        </div>
    </div>

    <hr>

    <div class="row nt-3">
        <div class="col">
            <h4>
                <?= $edit_icon ?>
                Editar Caixa
            </h4>
        </div>
        <div class="row mt-3">
            <form action="edit-caixa.php" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="row gap-2">
                    <!-- Coluna Nome -->
                    <div class="col col-7">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome do Caixa</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?= $caixa['nome']; ?>"
                                required>
                            <div class="invalid-feedback">
                                O campo é obrigatório
                            </div>
                        </div>
                    </div>
                    <!-- Coluna Saldo Inicial -->
                    <div class="col">
                        <div class="form-group">
                            <label for="saldo_inicial" class="form-label">Saldo Inicial</label>
                            <input type="text" name="saldo_inicial" id="saldo_inicial" class="form-control mask-value"
                                value="<?= $caixa['saldo_inicial']; ?>">
                        </div>
                    </div>
                    <!-- Botão Salvar -->
                    <div class="col col-1 d-flex align-items-end justify-content-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <div class="row mt-3">
        <div class="col">
            <h4><i class="fa-solid fa-pen-clip"></i> Lançamentos do Caixa</h4>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-add">Adicionar
                lançamento</button>
            <div class="d-flex mt-3 justify-content-between">
                <div class="d-flex">
                    <?= $msg; ?>
                </div>
                <p class="font-weight-bold m-0 justify-content-center align-self-center">
                    <small>Saldo Atual: </small>
                    <span class="fw-bold">R$
                        <?= saldo_float_to_str($caixa['saldo_atual']) ?>
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-end">
        <div class="col-4">
            <form method="get" id="form-filter-date">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="action" value="show">
                <div class="input-group">
                    <!-- Botão Limpar Filtro de Data -->
                    <span title="Limpar Busca" class="input-group-text" id="btn-filter-date-reset">
                        <i class="fa-solid fa-rotate-left"></i>
                    </span>
                    <!-- Botão Filtrar Data -->
                    <span title="Buscar" class="input-group-text" id="btn-filter-date">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <!-- Data Inicio (default: primeiro dia do mês atual) -->
                    <input type="date" name="data-ini" id="data-ini" value="<?= $data_ini ?? date('Y-m-01') ?>" class="form-control">
                    <!-- Data Final (default: ultimo dia do mês atual) -->
                    <input type="date" name="data-fin" id="data-fin" value="<?= $data_fin ?? date('Y-m-t') ?>" class="form-control">
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <!-- Titulos (colunas) -->
                <tr>
                    <th>Data Movimento</th>
                    <th>Discriminação</th>
                    <th class="text-center">Entrada</th>
                    <th class="text-center">Saída</th>
                    <th class="text-center">Saldo</th>
                    <th></th>
                </tr>

                <!-- Saldo Inicial -->
                <tr>
                    <td>-</td>
                    <td>Saldo Inicial</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center"><?= $caixa['saldo_inicial'] ?></td>
                    <td></td>
                </tr>

                <!-- Entradas movimentacoes (linhas) -->
                <?php foreach ($lancamentos as $item): ?>
                    <?php
                    $data = string_to_date($item['data_movimento']);
                    $entrada = $item['movimento'] == 'entrada' ? $item['valor_movimento'] : '-';
                    $saida = $item['movimento'] == 'saida' ? $item['valor_movimento'] : '-';
                    $saldo = $item['saldo'];
                    ?>
                    <tr>
                        <td>
                            <?= $data ?>
                        </td>
                        <td>
                            <?= $item['discriminacao_movimento'] ?>
                        </td>
                        <td class="text-center">
                            <?= $entrada != '-' ? saldo_float_to_str($entrada) : '-' ?>
                        </td>
                        <td class="text-center">
                            <?= $saida != '-' ? saldo_float_to_str($saida) : '-' ?>
                        </td>
                        <td class="text-center">
                            <?= saldo_float_to_str($saldo) ?>
                        </td>
                        <td><i class="fa-solid fa-pen-to-square"></i></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

    <!-- Modal Adicionar lançamento -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add-lancamento.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="id_caixa" value="<?= $id ?>">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-add-label">Adicionar lançamento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="discriminacao_movimento" class="form-label">Discriminação do Movimento</label>
                            <input type="text" name="discriminacao_movimento" for="discriminacao_movimento"
                                id="discriminacao_movimento" class="form-control" required>
                            <div class="invalid-feedback">O campo é obrigatório</div>
                        </div>
                        <div class="form-group">
                            <label for="data_movimento" class="form-label">Data do Lançamento</label>
                            <input type="date" name="data_movimento" for="data_movimento" id="data_movimento"
                                class="form-control" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback">O campo é obrigatório</div>
                        </div>
                        <div class="form-group">
                            <label for="valor_movimento" class="form-label">Valor do Lançamento</label>
                            <input type="text" name="valor_movimento" for="valor_movimento" id="valor_movimento"
                                class="form-control mask-value" required>
                            <div class="invalid-feedback">O campo é obrigatório</div>
                        </div>
                        <div class="form-group">
                            <label for="movimento" class="form-label">Tipo do Movimento</label>
                            <select name="movimento" id="movimento" class="form-control">
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Editar lançamento -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-edit-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-edit-label">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()

</script>

<?php include_once "footer.php"; ?>
