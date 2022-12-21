$(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#confirm-delete').length){
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white fw-bold">Desativação<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body card-fundo-body">Tem certeza que deseja desativar?<div class="modal-footer border-0 card-fundo-body p-1"><button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Não <i class="uil uil-times"></i></button><a class=" btn btn-sm btn-success text-white custom-close" id="dataComfirmOK">Sim <i class="uil uil-check"></i></a></div></div></div></div></div>');
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