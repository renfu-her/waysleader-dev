@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                <h1 class="display-1 mb-3">{{ $category['name'] }}</h1>
                @if($category['description'])
                    <p class="lead fs-lg mb-10">{{ $category['description'] }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-view projects-masonry">
            <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                @foreach($achievements as $achievement)
                    <div class="project item col-md-6 col-xl-4">
                        <figure class="lift rounded mb-6">
                            <a href="{{ route('achievements.show', $achievement['id']) }}">
                                @if($achievement['image_url'])
                                    <img src="{{ $achievement['image_url'] }}" 
                                         alt="{{ $achievement['title'] }}"
                                         class="img-fluid lazy">
                                @endif
                            </a>
                        </figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <h2 class="post-title h3">
                                    <a href="{{ route('achievements.show', $achievement['id']) }}"
                                       class="link-dark">
                                        {{ $achievement['title'] }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection 