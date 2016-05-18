@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <!-- MODAL CREATE CONTACT -->
    <div id="myModal" class="block modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="header-block border-radius">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="content-block modal-body">

                    {{ Form::model($customer, array('action' => array('CustomerContactController@create', $customer->id), 'method' => 'post')) }}

                        <div class="col-sm-12 input">
                            {!! Form::text('name_contact', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Nome Contato')) !!}
                        </div>

                        <div class="col-sm-6 input">
                            {!! Form::text('phone', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Telefone')) !!}
                        </div>

                        <div class="col-sm-6 input">
                            {!! Form::text('cell', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Celular')) !!}
                        </div>

                        <div class="col-sm-4 col-sm-offset-4">
                            {{Form::button('<i class="fa fa-plus" aria-hidden="true"></i>  Adicionar', array('type' => 'submit', 'class' => 'edit'))}}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <!-- MODAL CREATE CONTACT -->

    <div class="container content">
        <div class="row">

            <div class="col-sm-12">
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
            </div>

            <div class="col-sm-8 block">
                <div class="header-block border-radius">
                    <h1>Editar Cliente</h1>
                </div>

                <div class="content-block">
                    {{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT')) }}

                    <div class="col-sm-6 input">
                        {{ Form::text('name', null,
                        array('class' => 'border-radius',
                        'placeholder'=>'Nome da Empresa')) }}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>

                    <div class="col-sm-6 input">
                        {{ Form::text('cnpj', null,
                        array('class' => 'border-radius',
                        'placeholder'=>'CNPJ')) }}
                        @if ($errors->has('cnpj')) <p class="help-block">{{ $errors->first('cnpj') }}</p> @endif
                    </div>

                    <div class="col-sm-12 input">
                        {{ Form::file('image', null,
                        array('class' => 'border-radius')) }}
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('zipcode', null,
                        array('class' => 'border-radius',
                        'id' => 'cep',
                        'placeholder'=>'CEP')) }}
                        @if ($errors->has('zipcode')) <p class="help-block">{{ $errors->first('zipcode') }}</p> @endif
                        <div class='carregando' style='position:absolute;margin-left:5px;'></div>
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('street', null,
                        array('class' => 'border-radius',
                        'id' => 'rua',
                        'placeholder'=>'Rua')) }}
                        @if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('complement', null,
                        array('class' => 'border-radius',
                        'placeholder'=>'Complemento')) }}
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('neighborhood', null,
                        array('class' => 'border-radius',
                        'id' => 'bairro',
                        'placeholder'=>'Bairro')) }}
                        @if ($errors->has('neighborhood')) <p class="help-block">{{ $errors->first('neighborhood') }}</p> @endif
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('city', null,
                        array('class' => 'border-radius',
                        'id' => 'cidade',
                        'placeholder'=>'Cidade')) }}
                        @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                    </div>

                    <div class="col-sm-4 input">
                        {{ Form::text('state', null,
                        array('class' => 'border-radius',
                        'id' => 'estado',
                        'placeholder'=>'Estado')) }}
                        @if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
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


            <div class="col-sm-4 block border-radius">

                <div class="header-block border-radius">
                    <h1>Contatos</h1>
                </div>

                <div class="content-block">
                    @foreach ($contacts as $contact)
                        <div class="table text-center">

                            <div class="col-md-4 col-sm-12">
                                <strong>{{ $contact->name_contact }}</strong>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <p>{{ $contact->phone }}</p>
                                <p>{{ $contact->cell }}</p>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                {{ Form::model($contact, array('action' => array('CustomerContactController@destroy', $contact->id), 'method' => 'delete')) }}
                                    {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>  Deletar', array('type' => 'submit', 'class' => 'remove border-radius'))}}
                                {{ Form::close() }}
                            </div>

                        </div>
                    @endforeach
                    <div class="col-sm-8 col-sm-offset-2">
                        <a href="#" title="Adicionar" class="btn-add border-radius text-center" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Novo</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection