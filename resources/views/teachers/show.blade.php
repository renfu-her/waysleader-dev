@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body p-lg-8">
                        <div class="row gy-6">
                            <div class="col-lg-4">
                                @if($teacher['image_url'])
                                    <figure class="rounded">
                                        <img src="{{ $teacher['image_url'] }}" 
                                             alt="{{ $teacher['name'] }}"
                                             class="img-fluid">
                                    </figure>
                                @endif
                            </div>
                            
                            <div class="col-lg-8">
                                <h2 class="display-4 mb-3">{{ $teacher['name'] }}</h2>
                                <h3 class="fs-20 text-uppercase text-line text-primary mb-4">
                                    {{ $teacher['title'] }}
                                </h3>
                                
                                <div class="post-content">
                                    {!! $teacher['content'] !!}
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