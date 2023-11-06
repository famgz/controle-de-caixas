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
                            <input type="text" name="nome" id="nome" class="form-control"
                                value="<?= $caixa['nome']; ?>">
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
    
</div>

<?php include_once "footer.php"; ?>