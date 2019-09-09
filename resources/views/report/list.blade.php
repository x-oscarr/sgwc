@extends('builder.default')

@section('content')
    @if($reports != null)

        <div class="blockcontent">
            <h3 class="text-center">Reports</h3>
            {!! Form::open(['method' => 'get']) !!}
                <div class="form-row">
                    <div class="col-md-1 mb-3">
                        {!! Form::number('id', null, [
                            'class' => 'form-control',
                            'placeholder' => 'ID'
                        ]) !!}
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select" name="server" onchange='this.form.submit()'>
                            <option>All servers</option>
                            @foreach($servers_list as $server)
                                <option value="{{ $server->id }}">{{ $server->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        {!! Form::select('type', [
                            null => 'All report type',
                            'player_report' => 'Complaint on player',
                            'admin_report' => 'Complaint on admin',
                            'bug_report' => 'Bug report',
                            'tech_report' => 'Technical problems'
                        ], null, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="col-md-2 mb-3">
                        {!! Form::text('user', null, [
                            'class' => 'form-control',
                            'placeholder' => 'User',
                        ]) !!}
                    </div>
                    <div class="col-md-2 mb-3">
                        {!! Form::date('date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-1 mb-3">
                        <button type="submit" class="btn btn-primary">Find</button>
                    </div>
                </div>
            {!! Form::close() !!}

            @foreach($reports as $report)
                <a class="blockcontent row text-decoration-none blockcontent-hover" href="{{ route('report.single', $report->id) }}">
                    <div class="col-2">
                        @if($report->status == true)
                            <span class="badge badge-success">accepted</span>
                        @elseif($report->status == null)
                            <span class="badge badge-light">new</span>
                        @elseif($report->status == false)
                            <span class="badge badge-danger">denied</span>
                        @endif
                    </div>
                    <div class="col-10 col-sm-8 col-lg-6">
                        <span>
                            Report <strong>#</strong>{{ $report->id }}:
                            {{ str_limit($report->description, $limit = 80, $end = '...') }}
                        </span>
                    </div>
                    <div class="col-2 d-inline-block d-sm-none">

                    </div>
                    <div class="col-5 col-sm-2 col-2 mt-2 mt-sm-0">
                        <span>{{ $report->type }}</span>
                    </div>
                    <div class="col-5 col-lg-2 d-inline-block d-sm-none d-lg-inline-block mt-3 mt-sm-0">
                        <span>{{ $report->sender }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        Reports not found
    @endif
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
