$(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#confirm-delete').length){
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n\
        <div class="modal-dialog">\n\
<div class="modal-content">\n\
<div class="modal-header header-filtro">Download\n\
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">\n\
<span aria-hidden="true">&times;</span>\n\
</button></div><div class="modal-body card-fundo-body border-0">\
Tem certeza que deseja fazer o download?<br>\n\
<div class="modal-footer card-fundo-body p-0 border-0">\n\
<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="uil uil-times"></i> Não</button>\n\
<a class=" btn btn-sm btn-success text-white custom-close btnexecutafunc" id="dataComfirmOK"><i class="uil uil-check"></i> Sim</a>\n\
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