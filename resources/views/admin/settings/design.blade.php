@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Color scheme</h3>
        {!! Form::open(['files' => true, 'method' => 'post', 'name' => 'preloader']) !!}
        <div class="row mb-4">
            <div class="col-12 col-md-6">
                <div class="color-scheme-block">
                    <label style="background: red" for="primary"></label>
                    {!! Form::text('primary', null, [
                        'class' => 'form-control',
                        'placeholder' => '#ffffff'
                    ]) !!}
                    <span>Primary color</span>
                </div>
                <div class="color-scheme-block">
                    <label style="background: blue" for="primary"></label>
                    {!! Form::text('primary', null, [
                        'class' => 'form-control',
                        'placeholder' => '#ffffff'
                    ]) !!}
                    <span>Primary color</span>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="color-scheme-block">
                    <label style="background: lime" for="primary"></label>
                    {!! Form::text('primary', null, [
                        'class' => 'form-control',
                        'placeholder' => '#ffffff'
                    ]) !!}
                    <span>Primary color</span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="button" class="btn btn-secondary server-submit">Save cahnges</button>
        </div>
        {!! Form::close() !!}
    </section>
    <section>
        <h3 class="blockcontent-title">Design elements</h3>
        <h5 class="mt-4 mb-2 text-additional">Preloaders</h5>
        {!! Form::open(['files' => true, 'method' => 'post']) !!}
            <div class="preloader-grid">
                <label for="penguin" class="preloader-block">
                    {!! Form::radio('preloader', null, true, [
                        'id' => 'penguin',
                        'class' => 'radio-image'
                    ]) !!}
                    <img src="{{ asset('img/preloaders/penguin.gif') }}" alt="penguin">
                </label>
                <label for="cat" class="preloader-block">
                    {!! Form::radio('preloader', null, false, [
                        'id' => 'cat',
                        'class' => 'radio-image'
                    ]) !!}
                    <img src="{{ asset('img/preloaders/nyancat.gif') }}" alt="penguin">
                </label>

                <div class="preloader-block">
                    <label for="file" class="preloader-load">
                        <i class="fas fa-plus fa-3x"></i>
                    </label>
                    {!! Form::file('file', [
                        'id' => 'file',
                        'class' => 'preloader-load'
                    ]) !!}
                </div>
            </div>
        {!! Form::close() !!}
        <div class="row">
            <div class="col-12 col-md-4">
                {!! Form::open(['files' => true, 'method' => 'post']) !!}
                <h5 class="mt-4 mb-2 text-additional">Header logo</h5>
                <h5 class="mt-4 mb-2 text-additional">Background</h5>
                <div class="form-group d-flex">
                    {!! Form::color('bgColor', $settings['bgColor'], ['class' => 'form-control']) !!}
                    {!! Form::label('bgColor', 'Background color') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bgPicture', 'Background picture') !!}
                    {!! Form::file('bgPicture', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bgSize', 'Background size') !!}
                    {!! Form::text('bgSize', $settings['bgSize'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bgPosition', 'Background position') !!}
                    {!! Form::text('bgPosition', $settings['bgPosition'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bgRepeat', 'Background color') !!}
                    {!! Form::text('bgRepeat', $settings['bgRepeat'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bgAnimation', 'Background animation') !!}
                    {!! Form::select('bgAnimation', [
                        null => 'None',
                        1 => 'Jumping items',
                        2 => 'Particles',
                        3 => 'Snow',
                        4 => 'NASA',
                        5 => 'Bubble'
                    ], $settings['bgAnimation'], ['class' => 'form-control']) !!}
                </div>
                <h5 class="mt-4 mb-2 text-additional">Block content</h5>
                <div class="form-group">
                    {!! Form::label('bcBackground', 'Background color') !!}
                    {!! Form::text('bgRepeat', $settings['bgRepeat'], ['class' => 'form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-12 col-md-8">
                <div class="prewiev-content" >
                    <h5 class="mt-4 mb-2">Preview</h5>
                    <div id="bgPreview" style="
                        background-color: {{ $settings['bgColor'] }};
                        background-size: {{ $settings['bgSize'] }};
                        background-repeat: {{ $settings['bgRepeat'] }};
                        background-position: {{ $settings['bgPosition'] }};
                    ">
                        <div class="preview-block"></div>
                        <div class="preview-block"></div>
                        <div class="preview-block"></div>
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

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/admin/design.js') }}"></script>
@endsection
