@extends('builder.default')

@section('content')
    <section>
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
                        <a href="{{ asset($report->file) }}" target="_blank" class="text-secondary">Screenshot</a>
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
                        <a href="{{ $sender_url }}" class="text-secondary @if(!$sender_url) dis-link @endif">{!! $sender !!}</a>
                        <div>Perpetrator:</div>
                        <a href="{{ $perpetrator_url }}" class="text-secondary @if(!$perpetrator_url) dis-link @endif">{!! $perpetrator !!}</a>
                    </div>
                </div>
            </div>
        </div>
{{--        @if(Auth::user()->steam32)--}}
{{--            <div class="blockcontent">--}}
{{--                Dispute--}}
{{--            </div>--}}
{{--        @endif--}}
    </section>
@endsection

@section('sidebar')
    @include('report.sidebar')
@endsection
