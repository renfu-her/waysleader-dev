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
                                    @if ($course['category'])
                                        <div class="mb-3">
                                            <span class="category-badge">{{ $course['category'] }}</span>
                                        </div>
                                    @endif

                                    <h2 class="h2 mb-3">{{ $course['title'] }}</h2>
                                    @if ($course['subtitle'])
                                        <p class="fs-16 text-uppercase text-line text-primary mb-3">
                                            {{ $course['subtitle'] }}
                                        </p>
                                    @endif

                                    @if ($course['is_new'])
                                        <span class="badge bg-primary rounded-pill mb-4">新課程</span>
                                    @endif

                                    <div class="post-content">
                                        {!! $course['content'] !!}
                                    </div>

                                    @if (!empty($course['images']))
                                        <div class="row g-6 mt-6">
                                            <h3 class="h2 mb-3">課程相關圖片</h3>
                                            @foreach ($course['images'] as $image)
                                                <div class="col-md-6">
                                                    <figure class="hover-scale rounded cursor-dark">
                                                        <a href="{{ $image['image_url'] }}" data-glightbox
                                                            data-gallery="course">
                                                            <img src="{{ $image['image_url'] }}" alt="課程圖片"
                                                                class="img-fluid">
                                                        </a>
                                                    </figure>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .category-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
            padding: 6px 12px;
            padding-top: 8px !important;
            background-color: #ff9f43;
            color: #ffffff;
            border-radius: 5px;
            font-size: 0.875rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* 添加 iframe 容器樣式 */
        .post-content iframe {
            width: 100%;
            aspect-ratio: 16/9;
            border: 0;
        }

        /* 為舊瀏覽器提供支援 */
        @supports not (aspect-ratio: 16/9) {
            .post-content iframe {
                height: 56.25vw;
                /* 16:9 = 9/16 = 0.5625 */
                max-height: calc((100vw - 3rem) * 0.5625);
                /* 考慮容器邊距 */
            }
        }
    </style>
@endsection
