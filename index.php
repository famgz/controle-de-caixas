<?php
include_once "header.php";
include_once "index-action.php";
?>

<div class="container border round mt-3 p-3 shadow bg-light">
    <div class="row">
        <h3><i class="fa-solid fa-cash-register"></i>Controle de Caixas</h3>
    </div>

    <!-- Criar Novo Caixa -->
    <div class="row mt-3">
        <div class="col">
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add-new-caixa">
                <i class="fa-solid fa-plus"></i> Criar Novo Caixa
            </button>
        </div>
        <div class="col">
            <form method="get" id="form-search">
                <div class="input-group">
                    <span class="input-group-text" title="Limpar Busca" id="btn-clean">
                        <i class="fa-solid fa-rotate-left"></i>
                    </span>
                    <span class="input-group-text" title="Buscar" id="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" name="buscar" id="input-search" class="form-control" placeholder="Busca..."
                        value="<?= $busca ?? ''; ?>">
                </div>
            </form>
        </div>
        <div class="col">
            <form method="get" class="d-flex w-full justify-content-center" id="form-select-rpp">
                <input type="hidden" name="p" value="<?= '1'; ?>">
                <input type="hidden" name="busca" value="<?= $busca ?? ''; ?>">
                <div class="input-group">
                    <span class="input-group-text">Mostrar</span>

                    <select name="rpp" id="rpp" class="border btn btn-ouline-secondary">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="todos">Todos</option>
                    </select>

                    <span class="input-group-text">Resultados por Página</span>
                </div>
            </form>
        </div>
    </div>

    <!--  -->
    <div class="row mt-3">
        <div class="busca-result d-flex justify-content-between">
            <p>Mostrando 1 a 2 de 2</p>
            <p>Página 1 de 1</p>
        </div>
    </div>

    <!--  -->
    <div class="row mt-3">
        <div class="col">
            <?php
            if (!empty($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <div class="col" style="height: 74px;">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a title="Primeira Página" href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a title="Primeira Página" href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">1</span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a title="Primeira Página" href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">2</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a title="Primeira Página" href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">3</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a title="Primeira Página" href="" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!--  -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Caixa</th>
                        <th>Saldo Atual</th>
                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#123</td>
                        <td>Caixa</td>
                        <td>R$ 1.234,56</td>
                        <td class="text-center">
                            <a title="Detalhes do Caixa" href="">
                                <i class="fa-solid fa-circle-info action-icon icon-delete text-warning"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <i title="Excluir Caixa" class="fa-solid fa-trash-can action-icon icon-delete text-danger"
                                data-bs-toggle="modal" data-bs-target="#delete-caixa" data-id=""></i>
                        </td>
                    </tr>
                    <tr>
                        <td>#123</td>
                        <td>Caixa</td>
                        <td>R$ 1.234,56</td>
                        <td class="text-center">
                            <a title="Detalhes do Caixa" href="">
                                <i class="fa-solid fa-circle-info action-icon icon-delete text-warning"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <i title="Excluir Caixa" class="fa-solid fa-trash-can action-icon icon-delete text-danger"
                                data-bs-toggle="modal" data-bs-target="#delete-caixa" data-id=""></i>
                        </td>
                    </tr>
                    <tr>
                        <td>#123</td>
                        <td>Caixa</td>
                        <td>R$ 1.234,56</td>
                        <td class="text-center">
                            <a title="Detalhes do Caixa" href="">
                                <i class="fa-solid fa-circle-info action-icon icon-delete text-warning"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <i title="Excluir Caixa" class="fa-solid fa-trash-can action-icon icon-delete text-danger"
                                data-bs-toggle="modal" data-bs-target="#delete-caixa" data-id=""></i>
                        </td>
                    </tr>
                    <tr>
                        <td>#123</td>
                        <td>Caixa</td>
                        <td>R$ 1.234,56</td>
                        <td class="text-center">
                            <a title="Detalhes do Caixa" href="">
                                <i class="fa-solid fa-circle-info action-icon icon-delete text-warning"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <i title="Excluir Caixa" class="fa-solid fa-trash-can action-icon icon-delete text-danger"
                                data-bs-toggle="modal" data-bs-target="#delete-caixa" data-id=""></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Criar Novo Caixa -->
    <div class="modal fade" id="add-new-caixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add-caixa-action.php" method="post" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Novo Caixa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome do Caixa</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                            <div class="invalid-feedback">O campo é obrigatório.</div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="saldo-inicial" class="form-label">Saldo Inicial</label>
                            <input type="text" name="saldo-inicial" id="saldo-inicial" class="form-control mask-value">
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

    <!-- Confirma exclusão do Caixa -->
    <div class="modal fade" id="delete-caixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="delete-caixa-action.php" method="get">
                    <input type="hidden" name="id" value="">

                    <div class="modal-header bg-danger text-light">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <i class="fa-solid fa-triangle-exclamation"></i> ATENÇÃO!
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Confirma a exclusão do caixa e todos os lançamentos vinculados?</p>
                        <p>Importante: Esta ação não pode ser desfeita.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<!-- Validação de campos obrigatórios -->
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


<?php
include_once "footer.php";
?>