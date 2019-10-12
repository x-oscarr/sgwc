@extends('builder.default')

@section('content')
    @if($reports != null)

        <div class="blockcontent">
            <h3 class="text-center">Reports</h3>
            {!! Form::open(['method' => 'get']) !!}
                <div class="form-row">
                    <div class="col-md-1 mb-3">
                        {!! Form::number('id',  app('request')->get('id') ?? null, [
                            'class' => 'form-control',
                            'placeholder' => 'ID'
                        ]) !!}
                    </div>
                    <div class="col-md-4 mb-3">
                        {!! Form::select('server',
                            array(null => 'All servers') + $servers_arr,
                            app('request')->get('server') ?? null,
                            ['class' => 'custom-select'])
                        !!}
                    </div>
                    <div class="col-md-4 mb-3">
                        {!! Form::select('type',[
                            null => 'All report type',
                            'player_report' => 'Complaint on player',
                            'admin_report' => 'Complaint on admin',
                            'bug_report' => 'Bug report',
                            'tech_report' => 'Technical problems'
                        ], app('request')->get('type') ?? null, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="col-md-3 mb-3">
                        {!! Form::select('status', [
                            null => 'All statuses',
                            \App\Report::STATUS_NEW => 'New',
                            \App\Report::STATUS_ACCEPTED => 'Accepted',
                            \App\Report::STATUS_DENIED => 'Denied'
                        ], app('request')->get('status') ?? null, ['class' => 'custom-select']) !!}
                    </div>
                </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    {!! Form::date('date',  app('request')->get('date') ?? null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::text('user',  app('request')->get('user') ?? null, [
                        'class' => 'form-control',
                        'placeholder' => 'User (nickname or SteamID)',
                    ]) !!}
                </div>
                <div class="col-md-3 mb-3 d-flex">
                    {!! Form::select('order', [
                            null => 'Date ↓',
                            'id.asc' => 'Date ↑',
                            'status.desc' => 'Status ↓',
                            'status.asc' => 'Status ↑',
                            'perpetrator_name.desc' => 'Username ↓',
                            'perpetrator_name.asc' => 'Username ↑'
                        ], app('request')->get('order') ?? null, ['class' => 'custom-select mr-2']) !!}
                    <button type="submit" class="btn btn-primary">Find</button>
                </div>
            </div>
            {!! Form::close() !!}

            @if(!$reports->isEmpty())
                @foreach($reports as $report)
                    <a class="blockcontent row text-decoration-none blockcontent-hover" href="{{ route('report.single', $report->id) }}">
                        <div class="col-sm-2 col-md-1 d-none d-sm-block">
                            @if($report->status === \App\Report::STATUS_NEW)
                                <span class="badge badge-light">new</span>
                            @elseif($report->status === \App\Report::STATUS_ACCEPTED)
                                <span class="badge badge-success">accepted</span>
                            @elseif($report->status === \App\Report::STATUS_DENIED)
                                <span class="badge badge-danger">denied</span>
                            @endif
                        </div>
                        <div class="col-12 col-sm-7 col-lg-7">
                            <span>
                                Report <strong>#</strong>{{ $report->id }}:
                                {{ Str::limit($report->description, 80, '...') }}
                            </span>
                        </div>
                        <div class="col-4 d-block d-sm-none mt-2">
                            @if($report->status === \App\Report::STATUS_NEW)
                                <span class="badge badge-light">new</span>
                            @elseif($report->status === \App\Report::STATUS_ACCEPTED)
                                <span class="badge badge-success">accepted</span>
                            @elseif($report->status === \App\Report::STATUS_DENIED)
                                <span class="badge badge-danger">denied</span>
                            @endif
                        </div>
                        <div class="col-4 col-sm-3 col-lg-2 mt-2 mt-sm-0">
                            <span>{{ $report->created_at }}</span>
                        </div>
                        <div class="col-4 col-lg-2 d-inline-block d-sm-none d-lg-inline-block mt-2 mt-sm-0">
                            <span>{{ Str::limit($report->perpetrator_name, 20), '...' }}</span>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="text-center">Reports not find :(</p>
            @endif
        </div>
    @else
        Reports not found
    @endif
@endsection

@section('sidebar')
    @include('report.sidebar')
@endsection

@section('javascript')
{{--    <script>--}}
{{--        $('form').submit(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var data = $('form').serializeArray();--}}
{{--            var url = "{{ route('report.sort') }}";--}}
{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: url,--}}
{{--                data:  data,--}}
{{--                dataType: "json"--}}
{{--             });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
