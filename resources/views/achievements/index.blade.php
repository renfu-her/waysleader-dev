@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                <h1 class="display-1 mb-3">成果展示</h1>
                <p class="lead fs-lg mb-10">展現學習成果，分享創意靈感</p>
            </div>
        </div>

        <div class="row gx-md-8 gy-8">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg lift h-100">
                        <div class="card-body p-5 d-flex flex-column">
                            <h4 class="mb-3">{{ $category['name'] }}</h4>
                            @if($category['description'])
                                <p class="mb-4">{{ $category['description'] }}</p>
                            @endif
                            <a href="{{ route('achievements.category', $category['slug']) }}" 
                               class="btn btn-primary rounded-pill mt-auto">
                                查看作品
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection 