            $(document).ready(function () {
                $('.numero').mask('000');
                $('.date').mask('00/00/0000');
                $('.time').mask('00:00:00');
                $('.placa').mask('AAA-0000');
                $('.mercosul').mask('AAA0A00');
                $('.date_time').mask('00/00/0000 00:00:00');
                $('.cep').mask('00000-000');
                $('.phone').mask('(00) 0000-0000');
                $('.phone_with_ddd').mask('(00) 0 0000-0000');
                $('.phone_us').mask('(000) 000-0000');
                $('.mixed').mask('AAA 000-S0S');
                $('.matiptu').mask('000000-0');
                $('.metros').mask('000.000,00');
                $('.cpf').mask('000.000.000-00', {reverse: true});
                $('.rg').mask('00.000.000-0', {reverse: true});
                $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
                $('.taxa').mask('000.000.000.000.000,00', {reverse: true});
                $('.money2').mask("0.000,00", {reverse: true});
                $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                    translation: {
                        'Z': {
                            pattern: /[0-9]/, optional: true
                        }
                    }
                });
                $('.ip_address').mask('099.099.099.099');
                $('.percent').mask('##0,00%', {reverse: true});
                $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
                $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
                $('.fallback').mask("00r00r0000", {
                    translation: {
                        'r': {
                            pattern: /[\/]/,
                            fallback: '/'
                        },
                        placeholder: "__/__/____"
                    }
                });
                $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
            });