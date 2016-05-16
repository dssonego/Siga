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
                {{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT')) }}

                <div class="col-sm-6 input">
                    {{ Form::text('name', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Nome da Empresa')) }}
                </div>

                <div class="col-sm-6 input">
                    {{ Form::text('cnpj', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'CNPJ')) }}
                </div>

                <div class="col-sm-12 input">
                    {{ Form::file('image', null,
                    array('class' => 'border-radius')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('zipcode', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'CEP')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('street', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Rua')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('complement', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Complemento')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('neighborhood', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Bairro')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('city', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Cidade')) }}
                </div>

                <div class="col-sm-4 input">
                    {{ Form::text('state', null,
                    array('class' => 'border-radius',
                    'placeholder'=>'Estado')) }}
                </div>

                <div class="col-sm-offset-3 col-sm-3 input">
                    <a href="{{ URL::to('customers/') }}" title="Voltar" class="back border-radius text-center"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
                </div>

                <div class="col-sm-3 input">
                    {{Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar', array('type' => 'submit', 'class' => 'edit'))}}
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection