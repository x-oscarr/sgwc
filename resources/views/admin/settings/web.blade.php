@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Web Modules</h3>
        <div class="row">
            @foreach($siteModules as $siteModule)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-primary mb-4 card-item">
                        <div class="card-header">{{ $siteModule->name }}
                            <span class="float-right" id="pmStatus_{{ $siteModule->id }}">
                                @if($siteModule->is_enabled)
                                    <span class="badge badge-success">Enable</span>
                                @else
                                    <span class="badge badge-danger">Disable</span>
                                @endif
                            </span>
                        </div>
                        <div class="card-body position-relative">
                            <p class="card-text">{{ Str::limit($siteModule->description, 70, '...') }}</p>
                            <div class="mt-3 mb-3">
                                <div class="pm-card-server-addr">Version: {{ $siteModule->version }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-switch">
                                    {!! Form::checkbox('smEnable_'.$siteModule->id, true, $siteModule->is_enabled, ['class' => 'custom-control-input smEnable', 'data-id' => $siteModule->id,'id' => 'smEnable_'.$siteModule->id]) !!}
                                    {!! Form::label('smEnable_'.$siteModule->id, 'Enable', ['class' => 'custom-control-label']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('sidebar')
    @include('admin.settings.sidebar')
@endsection

@section('javascript')
    <script type="text/javascript">
        // Routes
        let routeSModuleUpdate = "{{ route('settings.sm.update') }}";
        // Texts
        let smStatusEnable = '<span class="badge badge-success float-right mt-1">Enable</span>';
        let smStatusDisable = '<span class="badge badge-danger float-right mt-1">Disable</span>';
    </script>

    <script type="text/javascript" src="{{ asset('js/admin/web.js') }}"></script>
@endsection
