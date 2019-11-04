@extends('builder.default')

@section('content')
    <section>
        @if($is_user_perpetrator)
            <div class="card text-white bg-danger">
                <div class="card-header">This is a complaint about you!</div>
                <div class="card-body">
                    <p class="card-text">
                        If you think you haven't violated the rules, you can dispute report.
                        <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#dispute">dispute</button>
                    </p>
                </div>
            </div>
        @endif
        <div class="blockcontent">
            <div class="row">
                <div class="col-12 text-right mb-2">
                    <h3 class="mb-0">REPORT <strong>#</strong>{{ $report->id }}</h3>
                    @if($report->status === \App\Report::STATUS_NEW)
                        <span class="badge badge-light float-left">new</span>
                    @elseif($report->status === \App\Report::STATUS_ACCEPTED)
                        <span class="badge badge-success float-left">accepted</span>
                    @elseif($report->status === \App\Report::STATUS_DENIED)
                        <span class="badge badge-danger float-left">denied</span>
                    @endif
                    <span class="sub-text">{{ $server->name }} • {{ $server->ip }}:{{ $server->port }}</span>
                </div>
                <div class="col-12 col-sm-8 col-md-9">
                    <p>
                        {{ $report->description }}
                    </p>
                    <p>Для завершення реєстрації необхідно перейти за надісланим посиланням у листі поштової скриньки.Для завершення реєстрації необхідно перейти за надісланим посиланням у листі поштової скриньки.</p>
                    <div>
                        <a href="{{ asset($report->file) }}" target="_blank" class="text-secondary">Screenshot</a>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-3 report-info">
                    <div class="report-info-block">
                        <div>Created At:</div>
                        <strong>{{ $report->created_at }}</strong>
                        <div>Report time:</div>
                        <strong>{{ $report->time }}</strong>
                    </div>
                    <div class="report-info-block">
                        <div>Sender:</div>
                        <a href="{{ $sender_url }}" class="text-secondary @if(!$sender_url) dis-link @endif">{!! $sender !!}</a>
                        <div>Perpetrator:</div>
                        <a href="{{ $perpetrator_url }}" class="text-secondary @if(!$perpetrator_url) dis-link @endif">{!! $perpetrator !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('report.sidebar')
@endsection

@section('modal.window')
    @if($is_user_perpetrator)
        <div class="modal fade" id="dispute" tabindex="-1" role="dialog" aria-labelledby="disputeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {!! Form::open(['files' => true, 'method' => 'post']) !!}
                        {!! Form::hidden('id', $id) !!}
                        <div class="modal-header">
                            <h5 class="modal-title" id="disputeLabel">Dispute report #{{ $report->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::textarea('info', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Describe the situation in detail (minimum 30 characters)'
                                ]) !!}
                                <div class="invalid-feedback" id="feedback-info"></div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Screenshot (if available)') !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control-file',
                                ]) !!}
                                <small>Available download formats: .png .jpg .jpeg .tiff .webp</small>
                                <div class="invalid-feedback" id="feedback-image"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitDispute">Send dispute</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection

@section('javascript')
    <script type="text/javascript">
        modalSuccessHTML = '<h2 class="text-center">Success! <i class="fas fa-check text-success"></i></h2><p class="text-center">Dispute successfully sent</p>';
        isSendDispute = '{{ $is_send_dispute }}';

        $(document).ready(function () {
            if(isSendDispute) {
                $(".modal-body").html(modalSuccessHTML);
                $("#submitDispute").detach();
            }

            $('#submitDispute').click(function () {
                data = $('form').serializeArray();
                console.log(data);
                $.ajax({
                    url: '{{ route('report.dispute', ['id' => $id]) }}',
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if(response.status) {
                            $(".modal-body").html(modalSuccessHTML);
                            $("#submitDispute").detach();
                        }
                    },
                    error: function(response) {
                        errors = response.responseJSON.errors;
                        if(errors.info) {
                            $("[name='info']").addClass("is-invalid");
                            $("#feedback-info").text(errors.info[0]);
                        }
                        else {
                            $("[name='info']").addClass("is-valid");
                        }

                        if(errors.image) {
                            $("[name='image']").addClass("is-invalid");
                            $("#feedback-image").text(errors.image[0]);
                        }
                        else {
                            $("[name='image']").addClass("is-valid");
                        }
                    }
                });
            })
        });
    </script>
@endsection
