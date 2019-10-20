@extends('builder.default')

@section('content')

    <section>
        <div class="jumbotron">
            <h1 class="display-3">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
        <h3 class="blockcontent-title">General settings</h3>
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                {!! Form::label('pTitle', 'Page Title') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('pTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => '• SGWC •'
                ]) !!}
            </div>
            <div class="col-12 col-md-4 mb-2">
                {!! Form::label('gTitle', 'Index Title (support <span> tag)') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('gTitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'Source<span>Game</span> Web Constructor'
                ]) !!}
            </div>
            <div class="col-12 col-md-4">
                {!! Form::label('projectName', 'Project Name') !!}
                {!! Form::text('ptitle', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('ptitle') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'Source Game Web Constructor'
                ]) !!}
            </div>
        </div>
    </section>
    <section>
        <h3 class="blockcontent-title">Menu Items</h3>
        <div class="row">
            <div class="col-12 col-md-4 d-flex align-items-start justify-content-between">
                <div class="tasks-wrapper" id="new">
                    <div class="task-title"><h3>Меню</h3></div>
                    <div class="task"><i class="fas fa-user"></i> Профиль</div>
                    <div class="task"><i class="fas fa-chart-line"></i> Рейтинг</div>
                    <div class="task"><i class="fas fa-book"></i> Правила</div>
                    <div class="task"><i class="fas fa-shopping-cart"></i> Донат</div>
                    <div class="task"><i class="fas fa-ban"></i> SourceBans</div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h3 class="blockcontent-title">Database Settings</h3>
        <div class="row">
            <div class="ccol-12 col-md-4">
                <div class="mb-2">
                    {!! Form::label('dHost', 'Database Host') !!}
                    {!! Form::text('dHost', null, [
                        'class' => 'form-control '.($errors->any() ? $errors->has('dHost') ? 'is-invalid' : 'is-valid' : ""),
                        'placeholder' => 'localhost',
                        'readonly' => 'readonly'
                    ]) !!}
                </div>
                <div class="mb-2">
                {!! Form::label('dUser', 'Database User') !!}
                {!! Form::text('dUser', null, [
                    'class' => 'form-control '.($errors->any() ? $errors->has('dUser') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => 'root',
                    'readonly' => 'readonly'
                ]) !!}
                </div>
                <div class="mb-2">
                {!! Form::label('dPass', 'Database Password') !!}
                {!! Form::password('dPass',[
                    'class' => 'form-control '.($errors->any() ? $errors->has('dPass') ? 'is-invalid' : 'is-valid' : ""),
                    'placeholder' => '********',
                    'readonly' => 'readonly'
                ]) !!}
                </div>
            </div>
            <div class="col-12 col-md-8">

            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function() {

            $('.task').draggable({
                helper: function() {var width = $(this).outerWidth();
                    return $(this).clone().appendTo("body").width(width);},
                zIndex:10
            });

        });

        $(".task").droppable({
            acept: function(el) {
                return el.hasClass("task")
            },
            drop: function(e, ui) {

                //e.target - принимающий
                //ui.draggable[0] - перетаскиваемый
                console.log(ui.draggable[0]);
                $(e.target).after(ui.draggable[0]);

                $(this).removeClass("over");
            },
            over: function(e, ui) {
                $(this).addClass("over");
            },
            out: function(e, ui) {
                $(this).removeClass("over");
            },

        });
    </script>
@endsection
