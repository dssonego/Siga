@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <div class="col-sm-6 title">
                <h1>Novo Cliente</h1>
            </div>

                {!! Form::open(['url' => 'customers']) !!}

                {!! Form::label('name','Nome') !!}
                {!! Form::text('name') !!}

                {!! Form::submit('Criar') !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection