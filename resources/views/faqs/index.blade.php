@extends('layouts.app')

@section('content')
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pt-md-18 pb-16 pb-md-18">
        <div class="row">
            <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                <h1 class="display-1 mb-3">常見問題</h1>
                <p class="lead fs-lg mb-10">以下是我們收集到的常見問題與解答</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div id="accordion-1" class="accordion-wrapper">
                    @foreach($faqs as $index => $faq)
                        <div class="card accordion-item">
                            <div class="card-header" id="accordion-heading-{{ $index }}">
                                <button class="accordion-button @if($index !== 0) collapsed @endif" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#accordion-collapse-{{ $index }}" 
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="accordion-collapse-{{ $index }}">
                                    {{ $faq['question'] }}
                                </button>
                            </div>
                            
                            <div id="accordion-collapse-{{ $index }}" 
                                 class="collapse @if($index === 0) show @endif" 
                                 aria-labelledby="accordion-heading-{{ $index }}" 
                                 data-bs-parent="#accordion-1">
                                <div class="card-body">
                                    <p>{!! $faq['answer'] !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 