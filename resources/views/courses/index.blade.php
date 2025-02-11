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
                            @if ($course['image_url'])
                                <figure class="card-img-top overlay overlay-1">
                                    <a href="{{ route('courses.show', $course['id']) }}">
                                        <img class="img-fluid lazy" src="{{ $course['image_url'] }}"
                                            alt="{{ $course['title'] }}">
                                        <span class="bg"></span>
                                    </a>
                                </figure>
                            @endif

                            <div class="card-body p-6">
                                <h2 class="mb-3 text-xl">{{ $course['title'] }}</h2>
                                @if ($course['is_new'])
                                    <span class="badge bg-primary rounded-pill mb-3">新課程</span>
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
