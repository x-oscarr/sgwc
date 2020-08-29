@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Servers</h3>
        {!! Form::open(['method' => 'post', 'id' => 'serversForm']) !!}
            @foreach($servers_list as $server)
                <div class="row blockserver mb-4">
                    <div class="col-12 col-md-3 mb-2">
                        <h6>{{ $server->name }}</h6>
                        {!! Form::text('ip_'.$server->id, $server->ip, [
                            'class' => 'form-control',
                            'placeholder' => 'ip address'
                        ]) !!}
                        {!! Form::text('port_'.$server->id, $server->port, [
                            'class' => 'form-control',
                            'placeholder' => 'port'
                        ]) !!}
                    </div>
                    <div class="col-6 col-md-4 mb-2">
                        <div class="custom-control custom-switch mb-2">
                            {!! Form::checkbox('monitoring_'.$server->id, true, $server->display, ['class' => 'custom-control-input', 'id' => 'monitoring_'.$server->id]) !!}
                            {!! Form::label('monitoring_'.$server->id, 'Monitoring', ['class' => 'custom-control-label']) !!}
                        </div>
                        <div class="custom-control custom-switch mb-2">
                            {!! Form::checkbox('display_'.$server->id, true, $server->monitoring, ['class' => 'custom-control-input', 'id' => 'display_'.$server->id]) !!}
                            {!! Form::label('display_'.$server->id, 'Display', ['class' => 'custom-control-label']) !!}
                        </div>
                        <div class="">Connection: <strong>{{ $serversMonitoring[$server->id]['online'] ? 'Connected' : 'No connection' }}</strong></div>
                        <div class="">Online:
                            <strong>
                                @if($serversMonitoring[$server->id]['online'])
                                    {{ $serversMonitoring[$server->id]['info']['players'] }} / {{ $serversMonitoring[$server->id]['info']['max_players'] }}
                                @else
                                    OFF
                                @endif
                            </strong>
                        </div>
                    </div>
                    <div class="col-6 col-md-5">
                        <button type="button" class="btn btn-outline-danger server-delete float-right" data-id="{{ $server->id }}"><i class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btn-primary server-add" data-toggle="modal" data-target="#addServer">Add server</button>
                <button type="button" class="btn btn-secondary server-submit" id="saveServers">Save cahnges</button>
            </div>
        {!! Form::close() !!}
    </section>
    <section>
        <h3 class="blockcontent-title">Plugin modules</h3>
        <div class="row">
            @foreach($pluginModules as $pluginModule)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-primary mb-4 card-item">
                        <div class="card-header">{{ $pluginModule->name }}
                            <span class="float-right" id="pmStatus_{{ $pluginModule->id }}">
                            @if($pluginModule->is_enabled)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                            </span>
                        </div>
                        <div class="card-body position-relative">
                            <div class="mb-3">
                                <div class="pm-card-server-name">{{ $pluginModule->server['name'] }}</div>
                                <div class="pm-card-server-addr">{{ $pluginModule->server['ip'] }}:{{ $pluginModule->server['port'] }}</div>
                            </div>
                            <p class="card-text">{{ Str::limit($pluginModule->description, 70, '...') }}</p>
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-switch">
                                    {!! Form::checkbox('pmEnable_'.$pluginModule->id, true, $pluginModule->is_enabled, ['class' => 'custom-control-input pmEnable', 'data-id' => $pluginModule->id,'id' => 'pmEnable_'.$pluginModule->id]) !!}
                                    {!! Form::label('pmEnable_'.$pluginModule->id, 'Enable', ['class' => 'custom-control-label']) !!}
                                </div>
                                <div>
                                    <a href="#" class="btn btn-secondary" title="Plugin modules settings"><i class="fas fa-cog"></i></a>
                                    <button type="button" class="btn btn-primary pmSettings" data-toggle="modal" data-target="#pmSettings" data-id="{{ $pluginModule->id }}" title="Connections settings"><i class="fas fa-plug"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('modal.window')
    <div class="modal fade" id="pmSettings" tabindex="-1" role="dialog" aria-labelledby="pmSettingsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'id' => 'pmFormUpdate']) !!}
                {!! Form::hidden('pmId', null) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="pmSettingsLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('plugin', 'Plugin module') !!}
                        {!! Form::select('plugin', $pluginModulesList, null, [
                            'class' => 'custom-select'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-server"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('server', 'Server') !!}
                        {!! Form::select('server', $servers_arr, null, [
                            'class' => 'custom-select'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-server"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('pmName', 'Module name') !!}
                        {!! Form::text('pmName', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Plugin Module'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-pmName"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', null, [
                            'class' => 'form-control',
                            'rows' => 4
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-description"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dbHost', 'Database Host') !!}
                        {!! Form::text('dbHost', null, [
                            'class' => 'form-control',
                            'placeholder' => 'localhost'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-dbHost"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dbPort', 'Database Port') !!}
                        {!! Form::text('dbPort', null, [
                            'class' => 'form-control',
                            'placeholder' => '3306'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-dbPort"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dbUser', 'Database Username') !!}
                        {!! Form::text('dbUser', null, [
                            'class' => 'form-control',
                            'placeholder' => 'root'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-dbUser"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dbPassword', 'Database password') !!}
                        {!! Form::text('dbPassword', null, [
                            'class' => 'form-control',
                            'placeholder' => '********'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-dbPassword"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dbName', 'Database name') !!}
                        {!! Form::text('dbName', null, [
                            'class' => 'form-control',
                            'placeholder' => 'db_name'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-dbName"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitPmSetting">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addServer" tabindex="-1" role="dialog" aria-labelledby="addServerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['method' => 'post', 'id' => 'addServerForm']) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServerLabel">Add new server</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('serverName', 'Server name') !!}
                            {!! Form::text('serverName', null, [
                                'class' => 'form-control',
                                'placeholder' => 'My new server'
                            ]) !!}
                            <div class="invalid-feedback" id="feedback-name"></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Server slug (short name without space)') !!}
                            {!! Form::text('slug', null, [
                                'class' => 'form-control',
                                'placeholder' => 'go_mg'
                            ]) !!}
                            <div class="invalid-feedback" id="feedback-slug"></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('ip', 'Server ip') !!}
                            {!! Form::text('ip', null, [
                                'class' => 'form-control',
                                'placeholder' => '111.111.111.111'
                            ]) !!}
                            <div class="invalid-feedback" id="feedback-ip"></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('port', 'Server port') !!}
                            {!! Form::text('port', null, [
                                'class' => 'form-control',
                                'placeholder' => '27015'
                            ]) !!}
                            <div class="invalid-feedback" id="feedback-port"></div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('rcon', 'Server rcon password') !!}
                            {!! Form::password('rcon', [
                                'class' => 'form-control',
                                'placeholder' => '********'
                            ]) !!}
                            <div class="invalid-feedback" id="feedback-rcon"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-outline-success" id="submitNewServer">Add server</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection

@section('javascript')
    <script type="text/javascript">
        // Routes
        let routeServersUpdate = "{{ route('settings.servers.update') }}";
        let routePModuleUpdate = "{{ route('settings.pm.update') }}";
        let routePModuleGet = "{{ route('settings.pm.get') }}";
        // Texts
        let buttonPreloader = '<i class="fas fa-spinner fa-pulse"></i>';
        let buttonSuccess = '<i class="fas fa-check"></i>';
        let pmStatusEnable = '<span class="badge badge-success float-right mt-1">Enable</span>';
        let pmStatusDisable = '<span class="badge badge-danger float-right mt-1">Disable</span>';
    </script>

    <script type="text/javascript" src="{{ asset('js/admin/servers.js') }}"></script>
@endsection
