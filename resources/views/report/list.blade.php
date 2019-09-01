@extends('builder.default')

@section('content')
    @if($reports != null)

        <div class="blockcontent">
            <h3 class="text-center">Reports</h3>
            @foreach($reports as $report)
                <a class="blockcontent row text-decoration-none" href="{{ route('report.single', $report->id) }}">
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
