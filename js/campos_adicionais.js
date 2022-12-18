var cont = 1;
        $('#btnmorador').click(function () {
             var codigo = document.getElementById("codMoradorPrincipal").value;
cont++;
        $('#morador').append('<div class="form-row" id="moradores' + cont + '"><input type="hidden" value="'+ codigo + '" name="subcodMorador[]"><div class="form-group col-md-5"><label for="nomemorador">Nome Completo</label><input type="text" class="form-control tamanhoInput" id="nomemorador" name="nomemorador[]"></div><div class="form-group col-md-3"><label for="parentesco">Parentesco</label><select id="parentesco" name="parentesco[]" class="form-control tamanhoInput"><option selected>Escolha uma opção ...</option><option value="Pai">Pai</option><option value="Mãe">Mãe</option><option value="Avô">Avô</option><option value="Avó">Avó</option><option value="Filho">Filho(a)</option><option value="Tio">Tio(a)</option><option value="Primo">Primo(a)</option><option value="Amigo">Amigo(a)</option><option value="Outros">Outros</option></select></div><div class="form-group col-md-3"><label for="dataNascimento">Data de Nascimento</label><input type="date" class="form-control tamanhoInput" id="dataNascimento" name="dataNascimento[]"></div><div class="form-group col-md-1 mt-2"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-apagar"><i class="fa fa-minus"></i></button></div></div>');
        });
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#moradores' + button_id + '').remove();
        });
        var cont = 1;
        var codigomempregado = document.getElementById("codMoradorPrincipal").value;
        $('#btnempregado').click(function () {
cont++;
        //https://api.jquery.com/append/
        $('#empregados').append('<div class="form-row" id="campoempregado' + cont + '"><input type="hidden" value="'+ codigomempregado + '" name="codmempregado[]"><div class="form-group col-md-7"><label for="empregado' + cont + '">Nome Completo</label><input type="text" class="form-control tamanhoInput"id="empregado' + cont + '" name="empregado[]"></div><div class="form-group col-md-4"><label for="rgempregado' + cont + '">RG</label><input type="text" class="form-control rg tamanhoInput" id="rgempregado' + cont + '" name="rgempregado[]" Placeholder="00.000.000-0" maxlength="12"></div><div class="form-group col-md-1 mt-2"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-apagarempregado"><i class="fa fa-minus"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagarempregado', function () {
var button_id = $(this).attr("id");
        $('#campoempregado' + button_id + '').remove();
});
        var cont = 1;
        var codigomveiculo = document.getElementById("codMoradorPrincipal").value;
        $('#btnveiculo').click(function () {
cont++;
        //https://api.jquery.com/append/
        $('#veiculos').append('<div class="form-row" id="campoveiculo' + cont + '"><input type="hidden" value="'+ codigomveiculo + '" name="codmveiculo[]"><div class="form-group col-md-5"><label for="modeloVeiculo' + cont + '">Marca/Modelo</label><input type="text" class="form-control tamanhoInput" id="modeloVeiculo' + cont + '" name="modeloVeiculo[]"></div><div class="form-group col-md-3"><label for="corVeiculo' + cont + '">Cor</label><input type="text" class="form-control tamanhoInput" id="corVeiculo' + cont + '" name="corVeiculo[]"></div><div class="form-group col-md-3"><label for="placaVeiculo' + cont + '">Placa</label><input type="text" class="form-control tamanhoInput" id="placaVeiculo' + cont + '" name="placaVeiculo[]" maxlength="7"></div><div class="form-group col-md-1 mt-2"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-apagarveiculo"><i class="fa fa-minus"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagarveiculo', function () {
var button_id = $(this).attr("id");
        $('#campoveiculo' + button_id + '').remove();
});

            var cont = 1;
            var codmanimais = document.getElementById("codMoradorPrincipal").value;
            $('#btnanimal').click(function () {
                cont++;
                //https://api.jquery.com/append/
                $('#animais').append('<div class="form-row mb-4" id="campoanimal' + cont + '"><input type="hidden" value="'+ codmanimais + '" id="codmanimais" name="codmanimais[]"><div class="form-group col-md-5"><label for="Especie' + cont + '">Espécie</label><input type="text" class="form-control tamanhoInput" id="Especie' + cont + '" name="Especie[]"></div><div class="form-group col-md-3"><label for="porte' + cont + '">Porte</label><select id="porte' + cont + '" name="porte[]" class="form-control tamanhoInput"><option selected>Escolha uma opção ...</option><option value="Pequeno">Pequeno</option><option value="Médio">Médio</option><option value="Grande">Grande</option></select></div><div class="form-group col-md-3"><label for="quantidade' + cont + '">Quantidade</label><input type="number" class="form-control tamanhoInput" id="quantidade' + cont + '" name="quantidade[]"></div><div class="form-group col-md-1 mt-2"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-apagaranimais"><i class="fa fa-minus"></i></button></div></div>');
            });

            $('form').on('click', '.btn-apagaranimais', function () {
                var button_id = $(this).attr("id");
                $('#campoanimal' + button_id + '').remove();
            });