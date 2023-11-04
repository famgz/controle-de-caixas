<?php
include_once "header.php";
include_once "index_action.php";
?>


<div class="container border round mt-3 p-3 shadow bg-light">
    <div class="row">
        <h3><i class="fa-solid fa-cash-register"></i>Controle de Caixas</h3>
    </div>
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
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include_once "footer.php";
?>