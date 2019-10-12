@extends('builder.default')

@section('content')
        <section>
            <h3 class="blockcontent-title">Create Report</h3>
            {!! Form::open(['files' => true, 'method' => 'post']) !!}
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        {!! Form::label('server', 'Server') !!}
                        <select class="custom-select" name="server" onchange='this.form.submit()'>
                            @foreach($servers_list as $server)
                                <option value="{{ $server->id }}" @if($server->id == $selected_server) selected @endif >{{ $server->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        {!! Form::label('type', 'Report type') !!}
                        {!! Form::select('type', [
                            \App\Report::TYPE_PLAYER_REPORT => 'Complaint on player',
                            \App\Report::TYPE_ADMIN_REPORT => 'Complaint on admin',
                            \App\Report::TYPE_BUG_REPORT => 'Bug report',
                            \App\Report::TYPE_TECH_REPORT=> 'Technical problems'
                        ], null, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="col-md-3 mb-3">
                        {!! Form::label('sender', 'Sender') !!}
                        {!! Form::text('sender', Auth::user() ? Auth::user()->steam32 : null, [
                            'class' => 'form-control '.($errors->any() ? $errors->has('sender') ? 'is-invalid' : 'is-valid' : ""),
                            'placeholder' => 'SteamID',
                            Auth::user() ? 'readonly' : null,
                        ]) !!}
                        @if($errors->has('sender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sender') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        {!! Form::label('perpetrator', 'Perpetrator (if need)') !!}
                        {!! Form::text('perpetrator', null, [
                            'class' => 'form-control '.($errors->any() ? $errors->has('perpetrator') ? 'is-invalid' : 'is-valid' : ""),
                            'placeholder' => 'SteamID or Nickname'
                        ]) !!}
                        @if($errors->has('perpetrator'))
                            <div class="invalid-feedback">
                                {{ $errors->first('perpetrator') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        {!! Form::label('date', 'Report date') !!}
                        {!! Form::date('date', \Carbon\Carbon::now(), [
                            'class' => 'form-control '.($errors->any() ? $errors->has('date') ? 'is-invalid' : 'is-valid' : ""),
                        ]) !!}
                        @if($errors->has('date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        {!! Form::label('date', 'Report time') !!}
                        {!! Form::time('time', \Carbon\Carbon::now(), [
                            'class' => 'form-control '.($errors->any() ? $errors->has('time') ? 'is-invalid' : 'is-valid' : ""),
                        ]) !!}
                        @if($errors->has('time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('time') }}
                            </div>
                        @endif
                    </div>
                    @if($rules_module && $rules_option)
                        <div class="col-md-8 mb-3">
                            {!! Form::label('rule', 'Violation of the rule (if need)') !!}
                            {!! Form::select('rule', array(null => 'Choose rule') + $rules_option, null, ['class' => 'custom-select']) !!}
                            @if($errors->has('time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rule') }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::textarea('info', null, [
                        'class' => 'form-control '.($errors->any() ? $errors->has('info') ? 'is-invalid' : 'is-valid' : ""),
                        'placeholder' => 'Describe the problem in detail (minimum 30 characters)'
                    ]) !!}
                    @if($errors->has('info'))
                        <div class="invalid-feedback">
                            {{ $errors->first('info') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        {!! Form::checkbox('anonymously', true, false,['class' => 'custom-control-input', 'id' => 'anonymously']) !!}
                        {!! Form::label('anonymously', 'Anonymously (Your nickname will not be displayed in the report except for administrators)', ['class' => 'custom-control-label']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('image', 'Screenshot (if available)') !!}
                    {!! Form::file('image', [
                        'class' => 'form-control-file '.($errors->any() ? $errors->has('image') ? 'is-invalid' : 'is-valid' : ""),
                    ]) !!}
                    @if($errors->has('info'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <small>Available download formats: .png .jpg .jpeg .tiff .webp</small>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Send report</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </section>
@endsection

@section('sidebar')
    @include('report.sidebar')
@endsection
