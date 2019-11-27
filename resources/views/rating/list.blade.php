@extends('builder.default')

@section('content')
    <section>
        <h3 class="blockcontent-title">Rating list</h3>
        <table class="table">
            <thead>
                <tr>
                    @foreach($rating_columns as $col)
                        <th scope="col">{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            @foreach($rating_data as $rating_row)
                <tr>
                    @foreach($rating_columns as $col)
                        <td>{{ $rating_row->{$col} }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
@endsection

@section('sidebar')
    @foreach($plugin_modules_names as $plugin_name)
        <a href="{{ route('rating', ['pm' => $plugin_name['plugin']]) }}">
            <i>[{{ Str::limit($plugin_name['name'], 1, '') }}]</i>
            <span class="sidebar-description">{{ $plugin_name['name'] }}</span>
        </a>
    @endforeach
@endsection
