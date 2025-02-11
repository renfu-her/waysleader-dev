@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $page['title'] }}</h1>

            @if ($page['image'])
                <img src="{{ $page['image'] }}" alt="{{ $page['title'] }}" class="img-fluid lazy mb-4">
            @endif

            <div class="content">
                {!! $page['content'] !!}
            </div>
        </div>
    </div>
@endsection
