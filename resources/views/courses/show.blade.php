@extends('layouts.app')

@section('content')
    <section class="wrapper">
        <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-lg-8 bg-light-blue rounded-3">
                            <h1 class="display-1 mb-3">{{ $course->title }}</h1>

                            @if ($course->image)
                                <figure class="rounded mb-6">
                                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="img-fluid lazy">
                                </figure>
                            @endif

                            <div class="blog single">
                                <div class="post-content">
                                    {!! $course->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .bg-light-blue {
            background-color: #cce6ff;
        }
        .post-content img {
            width: 100% !important;
            height: auto !important;
        }
    </style>
@endsection
