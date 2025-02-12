@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                <h1 class="display-1 mb-3">團隊師資</h1>
                <p class="lead fs-lg mb-10">專業的教學團隊，帶給您最優質的學習體驗</p>
            </div>
        </div>

        <div class="row gx-md-8 gy-8 text-center">
            @foreach($teachers as $teacher)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg lift h-100">
                        <div class="card-body">
                            @if($teacher['image_url'])
                                <div class="rounded-circle w-20 h-20 mx-auto mb-4 overflow-hidden">
                                    <img src="{{ $teacher['image_url'] }}" 
                                         alt="{{ $teacher['name'] }}"
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover;">
                                </div>
                            @endif
                            
                            <h4 class="mb-1">{{ $teacher['name'] }}</h4>
                            <div class="meta mb-2">{{ $teacher['title'] }}</div>
                            <p class="mb-2">{{ Str::limit(strip_tags($teacher['content']), 100) }}</p>
                            <a href="{{ route('teachers.show', $teacher['id']) }}" 
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