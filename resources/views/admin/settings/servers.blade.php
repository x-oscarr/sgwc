@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Servers</h3>
        {!! Form::open(['files' => true, 'method' => 'post']) !!}
        <div class="row blockserver mb-4">
            <div class="col-12 col-md-3 mb-2">
                <h6>|KTM| Minigame</h6>
                {!! Form::text('ip', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('pTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'ip address'
                ]) !!}
                {!! Form::text('port', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('gTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'port'
                ]) !!}
            </div>
            <div class="col-6 col-md-3 mb-2">
                <div class="custom-control custom-switch mb-2">
                    {!! Form::checkbox('monitoring', true, true, ['class' => 'custom-control-input', 'id' => 'monitoring']) !!}
                    {!! Form::label('monitoring', 'Monitoring', ['class' => 'custom-control-label']) !!}
                </div>
                <div class="custom-control custom-switch mb-2">
                    {!! Form::checkbox('display', true, true, ['class' => 'custom-control-input', 'id' => 'display']) !!}
                    {!! Form::label('display', 'Display', ['class' => 'custom-control-label']) !!}
                </div>
                <div class="">Connection: <strong>Connected</strong></div>
                <div class="">Online: <strong>12 / 25</strong></div>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-danger server-delete float-right"><i class="fas fa-trash-alt"></i> Delete</button>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="button" class="btn btn-primary server-add" data-toggle="modal" data-target="#addServer">Add server</button>
            <button type="button" class="btn btn-secondary server-submit">Save cahnges</button>
        </div>
        {!! Form::close() !!}
    </section>
    <section>
        <h3 class="blockcontent-title">Plugin modules</h3>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card border-primary mb-3">
                    <div class="card-header">Shop Minigame <span class="badge badge-success float-right mt-1">Enable</span></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="pm-card-server-name">|KTM| Minigame</div>
                            <div class="pm-card-server-addr">186.367.46.346:25554</div>
                        </div>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row">
                            <div class="col-6 custom-control custom-switch">
                                {!! Form::checkbox('pmEnable', true, true, ['class' => 'custom-control-input', 'id' => 'pmEnable']) !!}
                                {!! Form::label('pmEnable', 'Enable', ['class' => 'custom-control-label']) !!}
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-primary database-setting" id="pm1" data-toggle="modal" data-target="#pmSettings">Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-primary mb-3">
                    <div class="card-header">Shop Minigame <span class="badge badge-success float-right mt-1">Enable</span></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="pm-card-server-name">|KTM| Minigame</div>
                            <div class="pm-card-server-addr">186.367.46.346:25554</div>
                        </div>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row">
                            <div class="col-6 custom-control custom-switch">
                                {!! Form::checkbox('pmEnable', true, true, ['class' => 'custom-control-input', 'id' => 'pmEnable']) !!}
                                {!! Form::label('pmEnable', 'Enable', ['class' => 'custom-control-label']) !!}
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-primary database-setting" id="pm1" data-toggle="modal" data-target="#pmSettings">Settings</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-primary mb-3">
                    <div class="card-header">Shop Minigame <span class="badge badge-success float-right mt-1">Enable</span></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="pm-card-server-name">|KTM| Minigame</div>
                            <div class="pm-card-server-addr">186.367.46.346:25554</div>
                        </div>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row">
                            <div class="col-6 custom-control custom-switch">
                                {!! Form::checkbox('pmEnable', true, true, ['class' => 'custom-control-input', 'id' => 'pmEnable']) !!}
                                {!! Form::label('pmEnable', 'Enable', ['class' => 'custom-control-label']) !!}
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-primary database-setting" id="pm1" data-toggle="modal" data-target="#pmSettings">Settings</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal.window')
    <div class="modal fade" id="pmSettings" tabindex="-1" role="dialog" aria-labelledby="pmSettingsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {!! Form::open(['files' => true, 'method' => 'post']) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="pmSettingsLabel">Shop Minigame</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('server', 'Server') !!}
                        {!! Form::select('server', ['1' => '|KTM|Minigame'], null, [
                            'class' => 'form-control',
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-server"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Module info') !!}
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Plugin Module'
                        ]) !!}
                        <div class="invalid-feedback" id="feedback-name"></div>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="addServerLabel">Add new server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Server name') !!}
                        {!! Form::text('name', null, [
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
                    <button type="button" class="btn btn-outline-success" id="submitPmSetting">Add server</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection
