@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body p-lg-8">
                        <div class="row">
                            <div class="col-lg-8">
                                <h1 class="display-1 mb-3">{{ $course['title'] }}</h1>
                                @if($course['subtitle'])
                                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">{{ $course['subtitle'] }}</h2>
                                @endif
                                
                                @if($course['is_new'])
                                    <span class="badge bg-primary rounded-pill mb-4">新課程</span>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 mb-0">
                                        <div class="blog classic-view">
                                            <article class="post">
                                                @if($course['image_url'])
                                                    <figure class="rounded mb-6">
                                                        <img class="img-fluid lazy" src="{{ $course['image_url'] }}" alt="{{ $course['title'] }}">
                                                    </figure>
                                                @endif
                                                <div class="post-content">
                                                    {!! $course['content'] !!}
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($course['images']))
                                    <div class="row g-6 mt-6">
                                        <h3 class="h2 mb-3">課程相關圖片</h3>
                                        @foreach($course['images'] as $image)
                                            <div class="col-md-6">
                                                <figure class="hover-scale rounded cursor-dark">
                                                    <a href="{{ $image['image_url'] }}" data-glightbox data-gallery="course">
                                                        <img src="{{ $image['image_url'] }}" alt="課程圖片" class="img-fluid lazy">
                                                    </a>
                                                </figure>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 