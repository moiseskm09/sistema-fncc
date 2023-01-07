$(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#confirm-delete').length){
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n\
        <div class="modal-dialog modal-lg modal-dialog-scrollable">\n\
<div class="modal-content">\n\
<div class="modal-header header-filtro">TERMO DE CIÊNCIA E CONCORDÂNCIA\n\
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">\n\
<span aria-hidden="true">&times;</span>\n\
</button></div><div class="modal-body card-fundo-body">\n\
1. Declaro ter ciência e aceitar que os modelos (políticas, manuais, regulamentos, regimentos internos, atas, planilhas e outros relatórios) construídos e disponibilizados pela <strong class="destaque">Federação Nacional das Cooperativas de Crédito</strong> (<strong class="destaque">FNCC</strong>), apresentam sugestões de diretrizes e procedimentos que devem ser avaliados e adaptados de acordo com as particularidades da Cooperativa.<br><br>\n\
2. Os modelos disponíveis no sistema da <strong class="destaque"><strong class="destaque">FNCC</strong></strong>,devem ser avaliados pelas áreas técnicas da Cooperativa, a fim de identificar as ações necessárias para sua implantação e implementação.<br><br>\n\
3. A reprodução parcial ou total destes modelos de documentos será permitida somente as Cooperativas filiadas à <strong class="destaque">FNCC</strong>, portanto, não poderão ser compartilhadas com Cooperativa não filiadas.<br><br>\n\
4. Assim, declaro que a implantação e implementação dos referidos modelos de documentos disponibilizados pela <strong class="destaque">FNCC</strong>, sejam políticas, manuais, regulamentos, regimentos internos, atas, planilhas e outros relatórios são de inteira responsabilidade da Cooperativa sem qualquer ônus para a Federação Nacional de Cooperativas de Crédito (<strong class="destaque">FNCC</strong>), que apenas sugeriu os modelos.<br><br>\n\
5. Declaro ainda que aceito e concordo o teor deste Termo de Ciência e Concordância e comprometo a avaliar qualquer modelo de documento e adaptá-lo de acordo com a Cooperativa.</div>\n\
<div class="modal-footer card-fundo-body p-1">\n\
<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="uil uil-times"></i> Não Concordo</button>\n\
<a class=" btn btn-sm btn-success text-white custom-close" id="dataComfirmOK"><i class="uil uil-check"></i> Estou de Acordo</a>\n\
</div></div></div></div>');
		}
		$('#dataComfirmOK').attr('href', href);
                $('#confirm-delete').modal('show');
                $(function () {
    $(".custom-close").on('click', function() {
        $('#confirm-delete').modal('hide');
    });
});
                return false;
                
		
	});
});