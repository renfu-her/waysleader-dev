@extends('layouts.app')

@section('content')
    <section class="wrapper bg-light-blue">
        <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-lg-8">
                            <h1 class="display-1 mb-3">{{ $page['title'] }}</h1>

                            @if ($page['image'])
                                <figure class="rounded mb-6">
                                    <img src="{{ Storage::url($page['image']) }}" alt="{{ $page['title'] }}" class="img-fluid lazy">
                                </figure>
                            @endif

                            <div class="blog single">
                                <div class="post-content">
                                    {!! $page['content'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .bg-light-blue {
            background-color: #cce6ff;
        }
    </style>
@endpush
