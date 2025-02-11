@extends('layouts.app')

@section('content')
    <section class="wrapper overflow-hidden">
        <div class="container pt-19 pt-md-21 pb-16 pb-md-18 text-center position-relative">
            <div class="position-absolute" style="top: -12%; left: 50%; transform: translateX(-50%);" data-cue="fadeIn">
                <img src="{{ asset('assets/img/photos/blurry.png') }}" alt="">
            </div>

            <div class="row position-relative">
                <div class="col-lg-8 col-xxl-7 mx-auto position-relative">
                    <div class="position-absolute shape grape w-5 d-none d-lg-block" style="top: -5%; left: -15%;"
                        data-cue="fadeIn" data-delay="1500">

                    </div>

                    <div data-cues="slideInDown" data-group="page-title">
                        <h1 class="display-1 fs-64 mb-5 mx-md-10 mx-lg-0">歡迎來到{{ $siteSettings->site_name }}</h1>
                        <p class="lead fs-24 mb-8">探索科學的奧秘，啟發無限可能</p>
                    </div>

                    <div class="d-md-flex justify-content-center" data-cues="slideInDown" data-delay="600">
                        <span><a href="{{ route('courses.index') }}"
                                class="btn btn-lg btn-primary rounded-xl mx-md-1 mb-2 mb-md-0">查看課程</a></span>
                        <span><a href="{{ route('pages.show', 'about') }}"
                                class="btn btn-lg btn-fuchsia rounded-xl mx-md-1">了解更多</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row text-center">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <h3 class="fs-16 text-uppercase text-primary mb-3">課程分級</h3>
                    <p class="fs-18 mb-6">為不同程度的學習者提供合適的課程</p>
                </div>
            </div>

            <div class="position-relative">
                <div class="shape rounded-circle bg-soft-primary rellax w-16 h-16" data-rellax-speed="1"
                    style="top: -0.5rem; right: -2.2rem; z-index: 0;"></div>
                <div class="shape bg-dot primary rellax w-16 h-17" data-rellax-speed="1"
                    style="top: -0.5rem; left: -2.5rem; z-index: 0;"></div>

                <div class="row gx-md-5 gy-5 text-center">
                    <!-- 入門班 -->
                    <div class="col-md-4">
                        <div class="card shadow-lg lift h-100">
                            <div class="card-body p-6">
                                <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-4">
                                    <i class="uil uil-rocket"></i>
                                </div>
                                <h4 class="mb-3">入門班</h4>
                                <p class="mb-5">適合初次接觸科學的學習者，從基礎概念開始，循序漸進地學習。</p>
                                <a href="{{ route('courses.show', 1) }}" class="btn btn-primary rounded-pill">了解更多</a>
                            </div>
                        </div>
                    </div>

                    <!-- 進階班 -->
                    <div class="col-md-4">
                        <div class="card shadow-lg lift h-100">
                            <div class="card-body p-6">
                                <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-4">
                                    <i class="uil uil-chart-line"></i>
                                </div>
                                <h4 class="mb-3">進階班</h4>
                                <p class="mb-5">針對已有基礎的學習者，深入探討更複雜的科學概念與應用。</p>
                                <a href="{{ route('courses.show', 2) }}" class="btn btn-primary rounded-pill">了解更多</a>
                            </div>
                        </div>
                    </div>

                    <!-- 競賽班 -->
                    <div class="col-md-4">
                        <div class="card shadow-lg lift h-100">
                            <div class="card-body p-6">
                                <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-4">
                                    <i class="uil uil-trophy"></i>
                                </div>
                                <h4 class="mb-3">競賽班</h4>
                                <p class="mb-5">為有志參加科學競賽的學生提供專業訓練，培養解題與實作能力。</p>
                                <a href="{{ route('courses.show', 3) }}" class="btn btn-primary rounded-pill">了解更多</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 最新課程輪播 -->
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                    <h3 class="fs-16 text-uppercase text-primary mb-3">最新課程</h3>
                    <p class="fs-18 mb-6">探索我們的課程</p>
                </div>
            </div>

            <div class="swiper-container swiper-auto swiper-auto-xs mb-8" id="latest-courses">
                <div class="swiper overflow-visible">
                    <div class="swiper-wrapper">
                        <!-- 動態載入課程 -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $.get('{{ config('app.api_url') }}/api/v1/courses', function(response) {
                if (response.status === 'success' && response.data.length > 0) {
                    const swiperWrapper = $('.swiper-wrapper');

                    response.data.forEach(function(course) {
                        if (course.image_url) {
                            const slide = `
                                <div class="swiper-slide" style="width: 30%;">
                                    <figure class="rounded-xl shadow-xl h-60 m-3">
                                        <a href="/courses/${course.id}">
                                            <img src="${course.image_url}" 
                                                 alt="${course.title}" 
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;">
                                        </a>
                                    </figure>
                                    <div class="text-center mt-2">
                                        <h5 class="mb-0">${course.title}</h5>
                                    </div>
                                </div>
                            `;
                            swiperWrapper.append(slide);
                        }
                    });

                    // 初始化 Swiper
                    new Swiper('.swiper-auto', {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false
                        },
                        speed: 1000,
                        grabCursor: true,
                        breakpoints: {
                            // 當視窗寬度大於等於 320px
                            320: {
                                slidesPerView: 1,
                                spaceBetween: 20
                            },
                            // 當視窗寬度大於等於 768px
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 30
                            },
                            // 當視窗寬度大於等於 1024px
                            1024: {
                                slidesPerView: 3,
                                spaceBetween: 30
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
