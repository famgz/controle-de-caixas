<?php
include_once "library.php";
include_once "header.php";
include_once "index-action.php";
include_once "calcular-lancamentos.php";
?>

<div class="container border round mt-3 p-3 shadow bg-light">

    <div class="row">
        <h3><i class="fa-solid fa-cash-register"></i>Controle de Caixas</h3>
    </div>

    <div class="row mt-3">
        <!-- Botão Criar Novo Caixa -->
        <div class="col">
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add-new-caixa">
                <?= $plus_icon ?> Criar Novo Caixa
            </button>
        </div>

        <!-- Seção Filtrar por Nome -->
        <div class="col">
            <form method="get" id="form-search">
                <div class="input-group">
                    <!-- Botão executar busca -->
                    <span class="input-group-text" title="Limpar Busca" id="btn-clean">
                        <?= $rotate_icon ?>
                    </span>
                    <!-- Botão limpar busca -->
                    <span class="input-group-text" title="Buscar" id="btn-search">
                        <?= $glass_icon ?>
                    </span>
                    <input type="search" name="busca" id="input-search" class="form-control" placeholder="Busca..."
                        value="<?= $busca ?? ''; ?>">
                </div>
            </form>
        </div>

        <!-- Seção Mostrar Resultados por Página -->
        <div class="col">
            <form method="get" class="d-flex w-full justify-content-center" id="form-select-rpp">
                <input type="hidden" name="p" value="<?= '1'; ?>">
                <input type="hidden" name="busca" value="<?= $busca ?? ''; ?>">
                <div class="input-group d-flex justify-content-end">
                    <span class="input-group-text">Mostrar</span>

                    <select name="rpp" id="rpp" class="border btn btn-ouline-secondary px-0">
                        <option <?= $rpp == '10' ? 'selected' : '' ?> value="10">10</option>
                        <option <?= $rpp == '20' ? 'selected' : '' ?> value="20">20</option>
                        <option <?= $rpp == '40' ? 'selected' : '' ?> value="40">40</option>
                        <option <?= $rpp == 'todos' ? 'selected' : '' ?> value="todos">Todos</option>
                    </select>

                    <span class="input-group-text">itens por página</span>
                </div>
            </form>
        </div>
    </div>

    <!--  -->
    <div class="row mt-3">
        <div class="busca-result d-flex justify-content-between">
            <p>Mostrando
                <?= $offset + 1 ?> a
                <?= ($offset + $limit) > $qt_registros ? $qt_registros : ($offset + $limit) ?> de
                <?= $qt_registros ?>
            </p>
            <p>Página
                <?= $p ?> de
                <?= $qt_paginas ?>
            </p>
        </div>
    </div>

    <!--  -->
    <div class="row mt-3">
        <!-- Campo reservado para receber mensagens de status de ações -->
        <div class="col">
            <!-- Executar variável se existir -->
            <?php
            if (!empty($_SESSION['msg'])) { // sort of .get() function to avoid undefined key error
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <div class="col" style="height: 74px;">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">

                    <!-- Sufixo dos parâmetros URl -->
                    <?php
                        $_busca = $busca ? "&busca=" . $busca : '';
                        $_rpp = $rpp ? "&rpp=" . $rpp : '';
                        $params_suffix = $_busca . $_rpp;
                    ?>

                    <!-- Primeira Página << -->
                    <li class="page-item <?= $p <= 2 ? 'd-none' : '' ?>">
                        <a 
                            title="Primeira Página"
                            href="?p=1<?= $params_suffix ?>"
                            class="page-link"
                            aria-label="First"
                        >
                            <span aria-hidden="true">
                                &laquo;
                            </span>
                        </a>
                    </li>

                    <!-- Página anterior -->
                    <li class="page-item <?= $p <= 1 ? 'd-none' : '' ?>">
                        <a 
                            href="?p=<?= $p-1 . $params_suffix ?>"
                            class="page-link <?= $p <= 2 ? 'rounded-start' : '' ?>"
                            aria-label="Previous"
                        >
                            <span aria-hidden="true">
                                <?= $p-1 ?>
                            </span>
                        </a>
                    </li>

                    <!-- Página atual -->
                    <li class="page-item active">
                        <span 
                            class="page-link <?= $p <= 1 ? 'rounded-start' : '' ?> <?= $p == $qt_paginas ? 'rounded-end' : '' ?>"
                            aria-hidden="true"
                        >
                            <?= $p ?>
                        </span>
                    </li>

                    <!-- Página seguinte -->
                    <li class="page-item <?= $p >= $qt_paginas ? 'd-none' : '' ?>">
                        <a 
                            href="?p=<?= $p+1 . $params_suffix ?>"
                            class="page-link <?= $p == $qt_paginas-1 ? 'rounded-end' : '' ?>"
                            aria-label="Next"
                        >
                            <span aria-hidden="true">
                                <?= $p+1 ?>
                            </span>
                        </a>
                    </li>

                    <!-- Última Página >> -->
                    <li class="page-item <?= $p >= $qt_paginas-1 ? 'd-none' : '' ?>">
                        <a 
                            title="Última Página" 
                            href="?p=<?= $qt_paginas . $params_suffix ?>"
                            class="page-link" 
                            aria-label="Last"
                        >
                            <span aria-hidden="true">
                                &raquo;
                            </span>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

    <!-- Tabela -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <!-- Colunas -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Caixa</th>
                        <th>Saldo Atual</th>
                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>
                <!-- Linhas -->
                <tbody>
                    <?php foreach ($caixas as $caixa): ?>
                        <?php
                            calcular_lancamentos($caixa);  // calucla e adiciona a chave-valor saldo_atual ao array $caixa
                        ?>
                        <tr>
                            <td>#
                                <?= $caixa['id'] ?>
                            </td>
                            <td>
                                <?= $caixa['nome'] ?>
                            </td>
                            <td>R$
                                <?= saldo_float_to_str($caixa['saldo_atual']) ?>
                            </td>
                            <!-- Botão detalhes do Caixa -->
                            <td class="text-center">
                                <a title="Detalhes do Caixa" href="show-caixa.php?id=<?= $caixa['id'] ?>">
                                    <?= $warning_c_icon ?>
                                </a>
                            </td>
                            <!-- Botão excluir Caixa -->
                            <td class="text-center">
                                <a title="Excluir Caixa" data-bs-toggle="modal" data-bs-target="#delete-caixa" data-id="<?= $caixa['id'] ?>">
                                    <?= $trash_icon ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                            <input type="text" name="nome" id="nome" class="form-control">
                            <div class="invalid-feedback">O campo é obrigatório.</div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="saldo_inicial" class="form-label">Saldo Inicial</label>
                            <input type="text" name="saldo_inicial" id="saldo_inicial" class="form-control mask-value">
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

    <!-- Modal confirmar exclusão do Caixa -->
    <div class="modal fade" id="delete-caixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="delete-caixa-action.php">
                    <input type="hidden" name="id" value="" id="input-delete-id">
                    <div class="modal-header bg-danger text-light">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <?= $warning_t_icon ?>
                            ATENÇÃO!
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Confirma a exclusão do caixa e todos os lançamentos vinculados?</p>
                        <p>Importante: Esta ação não pode ser desfeita.</p>
                    </div>
                    <div class="modal-footer">
                        <!-- Botão Cancelar -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <!-- Botão Confirmar -->
                        <button type="submit" class="btn btn-danger" name="action" value="deletar">
                            Confirmar
                        </button>
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
