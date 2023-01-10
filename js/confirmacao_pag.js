$(document).ready(function(){
	$('a[bol-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#confirm-pag').length){
			$('body').append('<div class="modal fade" id="confirm-pag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n\
        <div class="modal-dialog">\n\
<div class="modal-content">\n\
<div class="modal-header text-white bg-success">Boleto\n\
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">\n\
<span aria-hidden="true">&times;</span>\n\
</button></div><div class="modal-body card-fundo-body border-0">\
Confirma o pagamento do boleto?<br>\n\
<div class="modal-footer card-fundo-body p-0 border-0">\n\
<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="uil uil-times"></i> Não</button>\n\
<a class=" btn btn-sm btn-success text-white custom-close" id="dataComfirmpagOK"><i class="uil uil-check"></i> Sim</a>\n\
</div></div></div></div>');
		}
		$('#dataComfirmpagOK').attr('href', href);
                $('#confirm-pag').modal('show');
                $(function () {
    $(".custom-close").on('click', function() {
        $('#confirm-pag').modal('hide');
    });
});
                return false;
                
		
	});
});