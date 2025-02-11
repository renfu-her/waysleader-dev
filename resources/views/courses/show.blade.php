@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">課程分級</a></li>
                    <li class="breadcrumb-item active">{{ $course['title'] }}</li>
                </ol>
            </nav>

            <h1>{{ $course['title'] }}</h1>
            @if ($course['subtitle'])
                <h4 class="text-muted">{{ $course['subtitle'] }}</h4>
            @endif

            @if ($course['is_new'])
                <span class="badge bg-success">新課程</span>
            @endif
        </div>

        @if ($course['image_url'])
            <div class="col-md-12 mt-4">
                <img src="{{ $course['image_url'] }}" alt="{{ $course['title'] }}" class="img-fluid lazy">
            </div>
        @endif

        <div class="col-md-12 mt-4">
            <div class="content">
                {!! $course['content'] !!}
            </div>
        </div>

        @if (!empty($course['images']))
            <div class="col-md-12 mt-4">
                <h3>課程相關圖片</h3>
                <div class="row">
                    @foreach ($course['images'] as $image)
                        <div class="col-md-4 mb-4">
                            <img src="{{ $image['image_url'] }}" alt="課程圖片" class="img-fluid lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection 