@extends('layouts.app')
@extends('inc.topo')

@section('content')
<div class="container content">
    <div class="row">

        <div class="col-sm-6 title">
            <h1>Clientes</h1>
        </div>

        <div class="col-sm-6">
            <a href="{{ URL::to('customers/create') }}" class="btn-add border-radius" title="Adicionar"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Novo</a>
        </div>

        <div class="col-sm-12">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
        </div>

        @foreach ($customers as $customer)
            <div class="col-sm-12 customers information mobile-center border-radius">
                @if(!empty($customer->image))
                    <div class="image" style="background:url({{URL::asset('img/customers-logo/'.$customer->image)}});">
                @else
                    <div class="image" style="background:url({{URL::asset('img/customers-logo/anonimo.png')}});">
                @endif
                </div>
                <div class="col-sm-3 table-information">
                    <h1>{{ $customer->name }}</h1>
                    <p>{{ $customer->cnpj }}</p>
                </div>
                <div class="col-sm-3 table-information">
                    @foreach($customer->address as $address)
                        <p>{{ $address->street }}, {{ $address->complement }}, {{ $address->zipcode }}, {{ $address->neighborhood }}, {{ $address->city }}, {{ $address->state }}</p>
                        <p></p>
                    @endforeach
                </div>
                <div class="col-sm-2 table-information text-center">
                    @if($customer->active == 0) <!-- ATIVO -->
                        <img src="{{URL::asset('/img/active.png')}}" alt="Ativo">
                        <p>Ativo</p>
                    @else <!-- INATIVO -->
                        <img src="{{URL::asset('/img/inactive.png')}}" alt="Inativo">
                        <p>Inativo</p>
                    @endif
                </div>

                <div class="col-sm-2 table-information text-center">
                    {{ Form::open(array('url' => 'customers/' . $customer->id)) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>  Deletar', array('type' => 'submit', 'class' => 'remove border-radius'))}}
                    {{ Form::close() }}
                </div>

                <div class="col-sm-2 table-information text-center">
                    <a href="{{ URL::to('customers/' . $customer->id . '/edit') }}" title="Editar" class="edit border-radius"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                </div>
            </div>
        @endforeach

        <?php echo $customers->render(); ?>

    </div>
</div>
@endsection