// Formatar input numérico do campo Saldo Inicial em `Criar Novo Caixa`
$(function() {
    $(".mask-value").mask("#.##0,00", { reverse: true });
})