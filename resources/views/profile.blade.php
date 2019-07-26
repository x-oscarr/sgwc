@extends('base')

@section('content')
    <div class="blockcontent">
        <div class="d-flex">
            <div>
                <img src="{{ Auth::user()->avatar }}">
            </div>
            <div>
                <span class="profile-username">{{ Auth::user()->username }}Ш</span>
            </div>

        </div>

    </div>
@endsection
