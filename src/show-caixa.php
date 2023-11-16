<?php
include_once "header.php";
include_once "show-caixa-action.php";
?>

<div class="container border round mt-3 p-3 shadow bg-light">
    <div class="row">
        <div class="col">
            <div class="row">
                <h3><i class="fa-solid fa-circle-exclamation"></i>Detalhes do Caixa</h3>
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
            <div class="row mt-3">
                <?= $msg; ?>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <p class="font-weight-bold"><small>Saldo Atual:</small> R$ 0,00</p>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Data Movimento</th>
                    <th>Discriminação</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Saldo</th>
                    <th></th>
                </tr>
                <tr>
                    <td>00/00/0000</td>
                    <td>Saldo anterior</td>
                    <td>-</td>
                    <td>-</td>
                    <td>0,00</td>
                    <td><i class="fa-solid fa-pen-to-square"></i></td>
                </tr>
                <tr>
                    <td>00/00/0000</td>
                    <td>Lançamento referente recebimento</td>
                    <td>100,00</td>
                    <td>-</td>
                    <td>100,00</td>
                    <td><i class="fa-solid fa-pen-to-square"></i></td>
                </tr>
                <tr>
                    <td>00/00/0000</td>
                    <td>Lançamento referente pagamento</td>
                    <td>-</td>
                    <td>50,00</td>
                    <td>50,00</td>
                    <td><i class="fa-solid fa-pen-to-square"></i></td>
                </tr>
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
                            <input type="text" for="discriminacao_movimento" id="discriminacao_movimento" class="form-control" required>
                            <div class="invalid-feedback">O campo é obrigatório</div>
                        </div>
                        <div class="form-group">
                            <label for="data_movimento" class="form-label">Data do Lançamento</label>
                            <input type="date" for="data_movimento" id="data_movimento" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback">O campo é obrigatório</div>
                        </div>
                        <div class="form-group">
                            <label for="valor_movimento" class="form-label">Valor do Lançamento</label>
                            <input type="text" for="valor_movimento" id="valor_movimento" class="form-control mask-value" required>
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