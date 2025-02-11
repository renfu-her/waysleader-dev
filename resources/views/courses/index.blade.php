@extends('layouts.app')

@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                    <h1 class="display-1 mb-3">課程分級</h1>
                    <p class="lead fs-lg mb-10">從入門到進階，為不同程度的學習者提供合適的課程</p>
                </div>
            </div>

            <div class="row gx-md-8 gy-8 text-center">
                @foreach ($courses as $course)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-lg lift h-100">
                            <div class="card-img-top position-relative">
                                @if ($course['image_url'])
                                    <figure class="overlay overlay-1" style="height: 400px;">
                                        <a href="{{ route('courses.show', $course['id']) }}">
                                            <img src="{{ $course['image_url'] }}" alt="{{ $course['title'] }}"
                                                class="img-fluid w-100 h-100"
                                                style="object-fit: cover; object-position: center;">
                                        </a>
                                    </figure>
                                    @if ($course['category'])
                                        <div class="position-absolute top-0 start-0 mt-3 ms-3">
                                            <span class="category-badge">{{ $course['category'] }}</span>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="card-body p-6">
                                <h2 class="mb-3 text-xl">{{ $course['title'] }}</h2>
                                @if ($course['is_new'])
                                    <span class="badge bg-danger rounded-pill mb-3">新課程</span>
                                @endif
                                <a href="{{ route('courses.show', $course['id']) }}"
                                    class="btn btn-primary rounded-pill mt-3">
                                    了解更多
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .category-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
            padding: 6px 12px;
            padding-top: 8px !important;
            background-color: #ff9f43;
            color: #ffffff;
            border-radius: 5px;
            font-size: 0.875rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
@endsection
