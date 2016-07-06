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
                <h1>Novo Contato</h1>
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
                    'id' => 'phone',
                    'placeholder'=>'Telefone')) !!}
                </div>

                <div class="col-sm-6 input">
                    {!! Form::text('cell', null,
                    array('class'=>'border-radius',
                    'id' => 'cell',
                    'placeholder'=>'Celular')) !!}
                </div>

                <div class="col-sm-4 col-sm-offset-4">
                    {{Form::button('<i class="fa fa-plus" aria-hidden="true"></i>  Adicionar', array('type' => 'submit', 'class' => 'btn-blue border-radius'))}}
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>
<!-- MODAL CREATE CONTACT -->

<div class="container content mobile-center">
    <div class="row">

        <div class="col-sm-12">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
        </div>

        <div class="col-sm-8 block border-radius">
            <div class="header-block border-radius">
                <h1>Visualizar Cliente</h1>
            </div>

            <div class="content-block">

                <div class="row">
                    <div class="col-sm-6 input">
                        <strong>Nome</strong>
                        <p>{{ $customer->name }}</p>
                    </div>

                    <div class="col-sm-6 input">
                        <strong>CNPJ</strong>
                        <p>{{ $customer->cnpj }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 input">
                        <strong>Imagem</strong>
                        <p><img src="{{URL::asset('img/customers-logo/'.$customer->image)}}" alt="{{ $customer->name }}" /></p>
                    </div>
                </div>

                @foreach($customer->address as $address)
                <div class="row">
                    <div class="col-sm-4 input">
                        <strong>CEP</strong>
                        <p>{{ $address->zipcode }}</p>
                    </div>

                    <div class="col-sm-4 input">
                        <strong>Rua</strong>
                        <p>{{ $address->street }}</p>
                    </div>

                    <div class="col-sm-4 input">
                        <strong>Complemento</strong>
                        <p>{{ $address->complement }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 input">
                        <strong>Bairro</strong>
                        <p>{{ $address->neighborhood }}</p>
                    </div>

                    <div class="col-sm-4 input">
                        <strong>Cidade</strong>
                        <p>{{ $address->city }}</p>
                    </div>

                    <div class="col-sm-4 input">
                        <strong>Estado</strong>
                        <p>{{ $address->state }}</p>
                    </div>
                </div>
                @endforeach

                <div class="col-sm-offset-3 col-sm-3 input">
                    <a href="{{ URL::to('customers/') }}" title="Voltar" class="btn-orange border-radius text-center"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
                </div>

                <div class="col-sm-3 input">
                    <a href="{{ URL::to('customers/'.$customer->id.'/edit') }}" title="Voltar" class="btn-blue border-radius text-center" style="margin-top:0;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                </div>

            </div>
        </div>


        <div class="col-sm-4 block border-radius">

            <div class="header-block border-radius">
                <h1>Contatos</h1>
            </div>

            <div class="content-block">
                @foreach ($contacts as $contact)
                    <div class="table text-center">
                        <div class="row">

                            <div class="col-md-4 col-sm-12">
                                <strong>{{ $contact->name_contact }}</strong>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <p>{{ $contact->phone }}</p>
                                <p>{{ $contact->cell }}</p>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                {{ Form::model($contact, array('action' => array('CustomerContactController@destroy', $contact->id), 'method' => 'delete')) }}
                                {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>  Deletar', array('type' => 'submit', 'class' => 'btn-red border-radius'))}}
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                @endforeach

                <div class="col-sm-8 col-sm-offset-2">
                    <a href="#" title="Adicionar" class="btn-green border-radius text-center" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Novo</a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection