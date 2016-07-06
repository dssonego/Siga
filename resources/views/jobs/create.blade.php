@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <div class="col-sm-12 block border-radius">

                <div class="header-block border-radius">
                    <h1>Cadastrar PIT</h1>
                </div>

                <div class="content-block">
                    {!! Form::open(['url' => 'jobs', 'files'=>true]) !!}

                    <div class="row">
                        <div class="col-sm-6 input">
                            <strong>Cliente</strong><br />
                            <select name="customer_id" class="border-radius">
                                <option value="">Selecione o Cliente</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('customer_id')) <p class="help-block">{{ $errors->first('customer_id') }}</p> @endif
                        </div>

                        <div class="col-sm-6 input">
                            <strong>Peça</strong><br />
                            <select name="part_id" class="border-radius">
                                <option value="">Selecione a Peça</option>
                                @foreach($parts as $part)
                                    <option value="{{ $part->id }}">{{ $part->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('part_id')) <p class="help-block">{{ $errors->first('part_id') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 input">
                            <strong>Titulo</strong><br />
                            {!! Form::text('title', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Titulo')) !!}
                            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                        </div>
                        <div class="col-sm-3 input">
                            <strong>Prazo</strong><br />
                            {!! Form::text('deadline', null,
                            array('class'=>'border-radius',
                            'id'=>'dp1',
                            'placeholder'=>'Prazo')) !!}
                            @if ($errors->has('deadline')) <p class="help-block">{{ $errors->first('deadline') }}</p> @endif
                        </div>
                        <div class="col-sm-3 input">
                            <strong>Horário</strong><br />
                            {!! Form::text('hour', null,
                            array('class'=>'border-radius',
                            'id'=>'hour',
                            'placeholder'=>'Horário')) !!}
                            @if ($errors->has('hour')) <p class="help-block">{{ $errors->first('hour') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 input">
                            <strong>Briefing</strong><br />
                            {!! Form::textarea('briefing', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Digite o Briefing Completo')) !!}
                            @if ($errors->has('briefing')) <p class="help-block">{{ $errors->first('briefing') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 input">
                            <strong>Responsável</strong><br />
                            <select name="responsable_id" class="border-radius">
                                <option value="">Selecione o Responsável</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('responsable_id')) <p class="help-block">{{ $errors->first('responsable_id') }}</p> @endif
                        </div>

                        <div class="col-sm-6 input">
                            <strong>Situação</strong><br />
                            <select name="situation_id" class="border-radius">
                                <option value="">Selecione a Situação</option>
                                @foreach($situations as $situation)
                                    <option value="{{ $situation->id }}">{{ $situation->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('situation_id')) <p class="help-block">{{ $errors->first('situation_id') }}</p> @endif
                        </div>
                    </div>

                    <div class="col-sm-offset-3 col-sm-3 input">
                        <a href="{{ URL::to('jobs/') }}" title="Voltar" class="btn-orange border-radius text-center"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
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