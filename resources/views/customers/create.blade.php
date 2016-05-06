@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <div class="col-sm-6 title">
                <h1>Novo Cliente</h1>
            </div>

            <div class="col-sm-12 form border-radius">
                {{ HTML::ul($errors->all()) }}
                    {!! Form::open(['url' => 'customers', 'files'=>true]) !!}

                    <div class="col-sm-6 input">
                        {!! Form::text('name', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Nome da Empresa')) !!}
                    </div>

                    <div class="col-sm-6 input">
                        {!! Form::text('cnpj', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'CNPJ')) !!}
                    </div>

                    <div class="col-sm-6 input">
                        {!! Form::file('image') !!}
                    </div>

                    <div class="col-sm-6 input">
                        {{ Form::select('active', ['Ativo', 'Desativo']) }}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('zipcode', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'CEP')) !!}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('street', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Rua')) !!}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('complement', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Complemento')) !!}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('neighborhood', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Bairro')) !!}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('city', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Cidade')) !!}
                    </div>

                    <div class="col-sm-4 input">
                        {!! Form::text('state', null,
                        array('class'=>'border-radius',
                        'placeholder'=>'Estado')) !!}
                    </div>

                    <div class="col-sm-12 input">
                        {!! Form::submit('Adicionar') !!}
                    </div>


                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection