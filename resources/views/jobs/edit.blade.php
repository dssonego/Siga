@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <div class="col-sm-12 block border-radius">

                <div class="row">
                    <div class="col-sm-12">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                    </div>
                </div>

                <div class="header-block border-radius">
                    <h1>Editar PIT - {{ $job->code }}</h1>
                </div>

                <div class="content-block">

                    <!-- ALTER JOB -->
                    <div class="row">
                        <div class="col-sm-9">
                            <p><strong>Aberto em:</strong> {{ date("d-m-Y H:i", strtotime($job->created_at)) }}</p>
                            <p><strong>Atualizado em:</strong> {{ date("d-m-Y H:i", strtotime($job->updated_at)) }}</p>
                        </div>
                        <div class="col-sm-3">
                            {{ Form::model($job, array('action' => array('JobController@alterJob', $job->id), 'method' => 'post')) }}

                                    <!-- Hidden Code -->
                                    {!! Form::hidden('code', null,
                                    array('class'=>'border-radius',
                                    'placeholder'=>'PIT')) !!}
                                    <!-- Hidden Code -->

                                {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>  Alterar PIT', array('type' => 'submit', 'class' => 'btn-blue border-radius'))}}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <!-- ALTER JOB -->

                    {{ Form::model($job, array('route' => array('jobs.update', $job->id), 'method' => 'PUT')) }}

                    <div class="row">
                        <div class="col-sm-6 input">
                            <strong>Cliente</strong><br />
                            <select name="customer_id" class="border-radius">
                                @foreach($job->customer as $jobcustomer)
                                    <option value="{{ $job->customer_id }}">{{ $jobcustomer->name }}</option>
                                @endforeach
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('customer_id')) <p class="help-block">{{ $errors->first('customer_id') }}</p> @endif
                        </div>

                        <div class="col-sm-6 input">
                            <strong>Peça</strong><br />
                            <select name="part_id" class="border-radius">
                                @foreach($job->jobPart as $jobpart)
                                    <option value="{{ $job->part_id }}">{{ $jobpart->name }}</option>
                                @endforeach
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
                            @foreach($briefings as $briefing )
                                <?php $i++; ?>
                                @if($i==1)
                                    <textarea name="briefing" class="border-radius" placeholder="Digite o Briefing" value="{{ $briefing->briefing }}" rows="8">{{ $briefing->briefing }}</textarea>
                                @else
                                    <div class="job_briefing_old border-radius">
                                        <p><?php echo nl2br($briefing->briefing) ?></p>
                                    </div>
                                @endif
                            @endforeach

                            @if ($errors->has('briefing')) <p class="help-block">{{ $errors->first('briefing') }}</p> @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 input">
                            <strong>Responsável</strong><br />
                            <select name="responsable_id" class="border-radius">
                                @foreach($job->responsableJob as $jobresponsable)
                                    <option value="{{ $job->responsable_id }}">{{ $jobresponsable->name }}</option>
                                @endforeach
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('responsable_id')) <p class="help-block">{{ $errors->first('responsable_id') }}</p> @endif
                        </div>

                        <div class="col-sm-6 input">
                            <strong>Situação</strong><br />
                            <select name="situation_id" class="border-radius">
                                @foreach($job->jobSituation as $jobsituation)
                                    <option value="{{ $job->situation_id }}">{{ $jobsituation->name }}</option>
                                @endforeach
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
                        {{Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar', array('type' => 'submit', 'class' => 'btn-blue border-radius'))}}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection