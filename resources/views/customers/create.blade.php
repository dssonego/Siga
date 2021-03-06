@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <div class="col-sm-12 block border-radius">

                <div class="header-block border-radius">
                    <h1>Cadastrar Cliente</h1>
                </div>

                <div class="content-block">
                    {!! Form::open(['url' => 'customers', 'files'=>true]) !!}

                        <div class="row">
                            <div class="col-sm-6 input">
                                <strong>Nome</strong><br />
                                {!! Form::text('name', null,
                                array('class'=>'border-radius',
                                'placeholder'=>'Nome da Empresa')) !!}
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>

                            <div class="col-sm-6 input">
                                <strong>CNPJ</strong><br />
                                {!! Form::text('cnpj', null,
                                array('class'=>'border-radius',
                                'placeholder'=>'CNPJ')) !!}
                                @if ($errors->has('cnpj')) <p class="help-block">{{ $errors->first('cnpj') }}</p> @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 input">
                                <strong>Imagem</strong><br />
                                {!! Form::file('image') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 input">
                                <strong>CEP</strong><br />
                                {!! Form::text('zipcode', null,
                                array('class'=>'border-radius',
                                'id'=>'cep',
                                'placeholder'=>'CEP')) !!}
                                @if ($errors->has('zipcode')) <p class="help-block">{{ $errors->first('zipcode') }}</p> @endif
                                <div class='carregando' style='position:absolute;margin-left:5px;'></div>
                            </div>

                            <div class="col-sm-4 input">
                                <strong>Rua</strong><br />
                                {!! Form::text('street', null,
                                array('class'=>'border-radius',
                                'id'=>'rua',
                                'placeholder'=>'Rua')) !!}
                                @if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
                            </div>

                            <div class="col-sm-4 input">
                                <strong>Complemento</strong><br />
                                {!! Form::text('complement', null,
                                array('class'=>'border-radius',
                                'placeholder'=>'Complemento')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 input">
                                <strong>Bairro</strong><br />
                                {!! Form::text('neighborhood', null,
                                array('class'=>'border-radius',
                                'id'=>'bairro',
                                'placeholder'=>'Bairro')) !!}
                                @if ($errors->has('neighborhood')) <p class="help-block">{{ $errors->first('neighborhood') }}</p> @endif
                            </div>

                            <div class="col-sm-4 input">
                                <strong>Cidade</strong><br />
                                {!! Form::text('city', null,
                                array('class'=>'border-radius',
                                'id'=>'cidade',
                                'placeholder'=>'Cidade')) !!}
                                @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                            </div>

                            <div class="col-sm-4 input">
                                <strong>Estado</strong><br />
                                {!! Form::text('state', null,
                                array('class'=>'border-radius',
                                'id'=>'estado',
                                'placeholder'=>'Estado')) !!}
                                @if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
                            </div>
                        </div>

                        <div class="col-sm-offset-3 col-sm-3 input">
                            <a href="{{ URL::to('customers/') }}" title="Voltar" class="btn-orange border-radius text-center"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
                        </div>

                        <div class="col-sm-3 input">
                            {{Form::button('<i class="fa fa-plus" aria-hidden="true"></i>  Adicionar', array('type' => 'submit', 'class' => 'btn-blue border-radius'))}}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection