@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Web Modules</h3>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card border-primary card-b">
                    <div class="card-header">Report System <span class="badge badge-success float-right mt-1">Enable</span></div>
                    <div class="card-body">
                        <p class="card-text">Reporting system that allows you to create reports.</p>
                        <div class="mt-3 mb-3">
                            <div class="pm-card-server-addr">Version: 1.0</div>
                        </div>
                        <div class="row">
                            <div class="col-6 custom-control custom-switch">
                                {!! Form::checkbox('pmEnable', true, true, ['class' => 'custom-control-input', 'id' => 'pmEnable']) !!}
                                {!! Form::label('pmEnable', 'Enable', ['class' => 'custom-control-label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection
