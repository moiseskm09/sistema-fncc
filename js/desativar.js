$(document).ready(function(){
	$('a[desativar-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#delete-c').length){
			$('body').append('<div class="modal fade" id="delete-c" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white fw-bold">Desativar / Excluir <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body card-fundo-body">Tem certeza que deseja desativar / Excluir?<div class="modal-footer border-0 card-fundo-body p-1"><button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="uil uil-times"></i> Não</button><a class=" btn btn-sm btn-success text-white custom-close btnexecutafunc" id="dataComfirmDOK"><i class="uil uil-check"></i> Sim</a></div></div></div></div></div>');
		}
		$('#dataComfirmDOK').attr('href', href);
                $('#delete-c').modal('show');
                $(function () {
    $(".custom-close").on('click', function() {
        $('#delete-c').modal('hide');
    });
});
                return false;
                
		
	});
});