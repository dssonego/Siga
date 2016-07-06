@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content mobile-center">
        <div class="row">

            <div class="col-sm-6 title">
                <h1>Pauta</h1>
            </div>

            <div class="col-sm-3">
                <a href="#" class="btn-blue border-radius text-center" id="pesquisa" title="Pesquisar"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</a>
            </div>

            <div class="col-sm-3">
                <a href="{{ URL::to('jobs/create') }}" class="btn-green border-radius text-center" title="Adicionar"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Novo</a>
            </div>

            <!-- SEARCH JOB -->
            <div class="col-sm-12 search-jobs border-radius">
                {!! Form::open(['url' => 'jobs', 'method'=> 'GET']) !!}

                    <div class="row mt">
                        <div class="col-sm-4 input">
                            {!! Form::text('deadline', null,
                            array('class'=>'border-radius',
                            'id'=>'dp1',
                            'placeholder'=>'Prazo')) !!}
                        </div>

                        <div class="col-sm-4 input">
                            {!! Form::text('code', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'PIT')) !!}
                        </div>

                        <div class="col-sm-4 input">
                            <select class="border-radius" name="customer_id">
                                <option value="">Cliente</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt">
                        <div class="col-sm-4 input">
                            {!! Form::text('title', null,
                            array('class'=>'border-radius',
                            'placeholder'=>'Titulo')) !!}
                        </div>
                        <div class="col-sm-4 input">
                            <select class="border-radius" name="responsable_id">
                                <option value="">Responsável</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 input">
                            <select class="border-radius" name="situation_id">
                                <option value="">Situação</option>
                                @foreach($situations as $situation)
                                    <option value="{{ $situation->id }}">{{ $situation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 input">
                            {{Form::button('<i class="fa fa-search" aria-hidden="true"></i>  Pesquisar PIT', array('type' => 'submit', 'class' => 'btn-blue border-radius'))}}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
            <!-- SEARCH JOB -->

            <div class="col-sm-12">
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
            </div>

            <div class="col-sm-12 count">
                @if($search == 0)
                    <p>Foram encontrados: {{ $countjobs }} PITs  - <a href="{{ URL::to('jobs/') }}" class="clear-search" title="Ver Todos">Limpar busca</a></p>
                @endif
            </div>

            <div class="col-sm-12 table-header border-radius">
                <div class="col-sm-2">
                    <p>Prazo</p>
                </div>
                <div class="col-sm-1">
                    <p>PIT</p>
                </div>
                <div class="col-sm-2">
                    <p>Cliente</p>
                </div>
                <div class="col-sm-2">
                    <p>Titulo</p>
                </div>
                <div class="col-sm-3">
                    <p>Responsável / Solicitante</p>
                </div>
                <div class="col-sm-2">
                    <p>Situação</p>
                </div>
            </div>

            @foreach($jobs as $job)

                <a href="{{ URL::to('jobs/' . $job->id . '/edit') }}" class="div-link" title="Visualizar">
                    <div class="col-sm-12 jobs information mobile-center border-radius">

                        @if($date_now <= $job->deadline)
                            <span class="yes-deadline"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
                        @else
                            <span class="no-deadline"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
                        @endif

                        <div class="col-sm-2 table-information border-bottom">
                           @if($date_now <= $job->deadline)
                                <p>
                           @else
                                <p style="color:#EF3A1B;">
                           @endif
                               {{ date("d-m-Y", strtotime($job->deadline)) }} / {{ $job->hour }}
                           </p>
                        </div>

                        <div class="col-sm-1 table-information border-bottom">
                           <p><strong>{{ $job->code }}</strong></p>
                        </div>

                        <div class="col-sm-2 table-information border-bottom">
                           @foreach($job->customer as $customer)
                              <p>{{ $customer->name }}</p>
                           @endforeach
                        </div>

                        <div class="col-sm-2 table-information border-bottom">
                           <p>{{ $job->title }}</p>
                        </div>

                        <div class="col-sm-3 table-information border-bottom">
                            @foreach($job->responsableJob as $responsableJob)
                                <p><strong> {{ $responsableJob->name }}</strong></p>
                            @endforeach
                            @foreach($job->requesterJob as $requesterJob)
                                <p style="font-size:12px;">{{ $requesterJob->name }}</p>
                                <p style="font-size:12px;">{{ date("d-m-Y / H:i", strtotime($job->created_at)) }}</p>
                            @endforeach
                        </div>

                        <div class="col-sm-2 table-information border-bottom">
                            @foreach($job->jobSituation as $jobSituation)
                                <p>{{ $jobSituation->name }}</p>
                            @endforeach
                        </div>

                    </div>
                </a>

            @endforeach

            <div class="col-sm-12 text-center">
                <?php echo $jobs->render(); ?>
            </div>

        </div>
    </div>
@endsection