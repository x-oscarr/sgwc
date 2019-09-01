@extends('builder.default')

@section('content')
        <section>
            <h3 class="blockcontent-title">Create Report</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['files' => true, 'method' => 'post']) !!}
                <div class="form-group">
                    <select class="custom-select" name="server" onchange='this.form.submit()'>
                        @foreach($servers_list as $server)
                            <option value="{{ $server->id }}" @if($server->id == $selected_server) selected @endif >{{ $server->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Report type') !!}
                    {!! Form::select('type', [
                        'player_report' => 'Complaint on player',
                        'admin_report' => 'Complaint on admin',
                        'bug_report' => 'Bug report',
                        'tech_report' => 'Technical problems'
                    ], null, ['class' => 'custom-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sender', 'Sender') !!}
                    {!! Form::text('sender', null, [
                        'class' => 'form-control',
                        'placeholder' => 'SteamID'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('perpetrator', 'Perpetrator (if need)') !!}
                    {!! Form::text('perpetrator', null, [
                        'class' => 'form-control',
                        'placeholder' => 'SteamID or Nickname'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('date', 'Report date') !!}
                    {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                    {!! Form::time('time', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('image', 'Screenshot') !!}
                    {!! Form::file('image', ['class' => 'form-control-file']) !!}
                    <small>Available download formats: .png .jpg .jpeg .tiff .webp</small>
                </div>
                <div class="custom-control custom-checkbox">
                    {!! Form::checkbox('anonymously', true, false,['class' => 'custom-control-input', 'id' => 'anonymously']) !!}
                    {!! Form::label('anonymously', 'Anonymously (Your nickname will not be displayed in the report except for administrators', ['class' => 'custom-control-label']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send report</button>
                </div>
            {!! Form::close() !!}
        </section>
@endsection
