<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Siga Papagaio</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>

    <!-- CEP AUTOMATIC -->
    <script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
    <script>
        $(document).ready( function() {
            /* Executa a requisição quando o campo CEP perder o foco */
            $('#cep').blur(function(){
                /* Configura a requisição AJAX */
                $.ajax({
                    url : '{{asset('js/cep/consultar_cep.php')}}', /* URL que será chamada */
                    type : 'POST', /* Tipo da requisição */
                    data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                    dataType: 'json', /* Tipo de transmissão */
                    beforeSend: function(){
                        $(".carregando").html("<img src='{{asset('img/loading.gif')}}'>");
                        //$("#carregando").show();
                    },
                    success: function(data){
                        $(".carregando").fadeOut();
                        if(data.sucesso == 1){
                            $('#rua').val(data.rua);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            $('#estado').val(data.estado);

                            $('#numero').focus();
                        }
                    }
                });
                return false;
            })
        });
    </script>
    <!-- CEP AUTOMATIC -->

</head>
<body id="app-layout">

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
