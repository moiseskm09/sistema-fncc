$(function () {
    //Comportamento do botao de disparo
    $('.loading').click(function () {
        if (nomeCategoriaN.value === '') {
        } else {
            getResponse();
        }
        if (tituloDocN.value === '' || arquivoN.value === '' || categoriaDocN.value === '') {
        } else {
            getResponse();
        }
        if (cod_categoria_doc.value === '' || titulo_doc.value === '') {
        } else {
            getResponse();
        }
    });
});

$(function () {
    //Comportamento do botao de disparo
    $('.btnexecutafunc').click(function () {
            getResponse();
    });
});
/**
 * Dispara o modal e espera a resposta do script 'testing.resp.php'
 * @returns {void}
 */
function getResponse() {
    //Preenche e mostra o modal
    $('#loadingModal_content').html('Processando...');
    $('#loadingModal').modal('show');
    //Envia a requisicao e espera a resposta
    $.post("reenviar.php")
            .done(function () {
                //Se nao houver falha na resposta, preenche o modal
                $('#loader').removeClass('loader');
                $('#loader').addClass('glyphicon glyphicon-ok');
                $('#loadingModal_label').html('Sucesso!');
                $('#loadingModal_content').html('<br>Processando!');
                resetModal();
            })
            .fail(function () {
                //Se houver falha na resposta, mostra o alert
                $('#loader').removeClass('loader');
                $('#loader').addClass('glyphicon glyphicon-remove');
                $('#loadingModal_label').html('Falha!');
                $('#loadingModal_content').html('<br>Processando...');
                resetModal();
            });
}
function resetModal() {
    //Aguarda 2 segundos ata restaurar e fechar o modal
    setTimeout(function () {
        $('#loader').removeClass();
        $('#loader').addClass('loader');
        $('#loadingModal_label').html('<span class="glyphicon glyphicon-refresh"></span>Aguarde...');
        $('#loadingModal').modal('hide');
    }, 3000);
}