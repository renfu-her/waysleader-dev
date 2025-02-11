@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>課程分級</h1>
        </div>

        @foreach ($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($course['image_url'])
                        <img src="{{ $course['image_url'] }}" class="card-img-top lazy" alt="{{ $course['title'] }}">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $course['title'] }}</h5>
                        @if ($course['is_new'])
                            <span class="badge bg-success">新課程</span>
                        @endif
                        <a href="{{ route('courses.show', $course['id']) }}" class="btn btn-primary mt-2">查看詳情</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
