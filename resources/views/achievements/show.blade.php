@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body p-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-4">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('achievements.index') }}">成果展示</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('achievements.category', $achievement['category']['slug']) }}">
                                                {{ $achievement['category']['name'] }}
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ $achievement['title'] }}
                                        </li>
                                    </ol>
                                </nav>

                                <h1 class="display-1 mb-4">{{ $achievement['title'] }}</h1>

                                @if($achievement['image_url'])
                                    <figure class="rounded mb-6">
                                        <img src="{{ $achievement['image_url'] }}" 
                                             alt="{{ $achievement['title'] }}"
                                             class="img-fluid lazy">
                                    </figure>
                                @endif

                                <div class="blog single">
                                    <div class="post-content">
                                        {!! $achievement['content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 