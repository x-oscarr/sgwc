@extends('builder.default')

@section('content')
    <div class="blockcontent">
        <div class="blockcontent">
            <div class="row">
                <div class="col-12 text-right mb-2">
                    <h3 class="mb-0">REPORT <strong>#</strong>{{ $report->id }}</h3>
                    @if($report->status == true)
                        <span class="badge badge-success float-left">accepted</span>
                    @elseif($report->status == null)
                        <span class="badge badge-light float-left">new</span>
                    @elseif($report->status == false)
                        <span class="badge badge-danger float-left">denied</span>
                    @endif
                    <span class="sub-text">{{ $server->name }} • {{ $server->ip }}:{{ $server->port }}</span>
                </div>
                <div class="col-12 col-sm-8 col-md-9">
                    <p>
                        {{ $report->description }}
                    </p>
                    <p>Для завершення реєстрації необхідно перейти за надісланим посиланням у листі поштової скриньки.Для завершення реєстрації необхідно перейти за надісланим посиланням у листі поштової скриньки.</p>
                    <div>
                        <a href="{{ asset('img/preloaders/diamond.gif') }}" target="_blank" class="text-secondary">IMG_25326626.gif</a>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-3 report-info">
                    <div class="report-info-block">
                        <div>Created At:</div>
                        <strong>{{ $report->created_at }}</strong>
                        <div>Report time:</div>
                        <strong>{{ $report->time }}</strong>
                    </div>
                    <div class="report-info-block">
                        <div>Sender:</div>
                        <a href="{{ route('steamid', $report->sender) }}" class="text-secondary">{{ $sender }}</a>
                        <div>Perpetrator:</div>
                        <a href="{{ route('steamid', $report->perpetrator) }}" class="text-secondary">{{ $perpetrator }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
