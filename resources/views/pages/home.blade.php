@extends('layouts.app')

@section('content')
<section class="wrapper overflow-hidden">
    <div class="container pt-19 pt-md-21 pb-16 pb-md-18 text-center position-relative">
        <div class="position-absolute" style="top: -12%; left: 50%; transform: translateX(-50%);" data-cue="fadeIn">
            <img src="{{ asset('assets/img/photos/blurry.png') }}" alt="">
        </div>
        
        <div class="row position-relative">
            <div class="col-lg-8 col-xxl-7 mx-auto position-relative">
                <div class="position-absolute shape grape w-5 d-none d-lg-block" style="top: -5%; left: -15%;" data-cue="fadeIn" data-delay="1500">
                    <img src="{{ asset('assets/img/svg/pie.svg') }}" class="svg-inject icon-svg w-100 h-100" alt="">
                </div>
                
                <div data-cues="slideInDown" data-group="page-title">
                    <h1 class="display-1 fs-64 mb-5 mx-md-10 mx-lg-0">歡迎來到{{ $siteSettings->site_name }}</h1>
                    <p class="lead fs-24 mb-8">探索科學的奧秘，啟發無限可能</p>
                </div>

                <div class="d-md-flex justify-content-center" data-cues="slideInDown" data-delay="600">
                    <span><a href="{{ route('courses.index') }}" class="btn btn-lg btn-primary rounded-xl mx-md-1 mb-2 mb-md-0">查看課程</a></span>
                    <span><a href="{{ route('pages.show', 'about') }}" class="btn btn-lg btn-fuchsia rounded-xl mx-md-1">了解更多</a></span>
                </div>
            </div>
        </div>
    </div>

    <!-- 最新課程輪播 -->
    <div class="swiper-container swiper-auto swiper-auto-xs mb-8" id="latest-courses">
        <div class="swiper overflow-visible pe-none">
            <div class="swiper-wrapper ticker">
                <!-- 動態載入課程 -->
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // 獲取最新課程並添加到輪播
    $.get('{{ config("app.api_url") }}/api/v1/courses', function(response) {
        if (response.status === 'success' && response.data.length > 0) {
            const swiperWrapper = $('.swiper-wrapper');
            
            response.data.forEach(function(course) {
                if(course.image_url) {
                    const slide = `
                        <div class="swiper-slide">
                            <figure class="rounded-xl shadow-xl">
                                <img src="${course.image_url}" alt="${course.title}" class="lazy">
                            </figure>
                        </div>
                    `;
                    swiperWrapper.append(slide);
                }
            });

            // 初始化 Swiper
            new Swiper('.swiper-auto', {
                slidesPerView: 'auto',
                spaceBetween: 40,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false
                },
                speed: 7000,
                grabCursor: false,
                mousewheelControl: false,
                keyboardControl: false,
                navigation: false
            });
        }
    });
});
</script>
@endsection 