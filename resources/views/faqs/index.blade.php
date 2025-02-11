@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>常見問題</h1>

            <div class="accordion mt-4" id="faqAccordion">
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button @if($index !== 0) collapsed @endif" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" 
                             class="accordion-collapse collapse @if($index === 0) show @endif"
                             aria-labelledby="heading{{ $index }}" 
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {!! $faq['answer'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 