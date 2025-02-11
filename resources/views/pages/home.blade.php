@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h1>歡迎來到{{ $siteSettings->site_name ?? '科普班長' }}</h1>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">關於科普</h5>
                    <p class="card-text">了解我們的理念與使命，探索科學普及教育的重要性。</p>
                    <a href="{{ route('pages.show', 'about') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">課程教學</h5>
                    <p class="card-text">探索我們豐富多樣的課程，從入門到進階，適合不同程度的學習者。</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">查看課程</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">成果展示</h5>
                    <p class="card-text">查看學員們的學習成果與作品展示。</p>
                    <a href="#" class="btn btn-primary">瀏覽作品</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center mb-4">最新課程</h2>
        </div>
        <div class="col-md-12">
            <div class="row" id="latest-courses">
                <!-- 這裡可以通過 API 獲取最新課程數據 -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // 獲取最新課程
            $.get('{{ config("app.api_url") }}/api/v1/courses', function(response) {
                if (response.status === 'success' && response.data.length > 0) {
                    const courses = response.data.slice(0, 3); // 只顯示前3個課程
                    const courseContainer = $('#latest-courses');
                    
                    courses.forEach(function(course) {
                        const courseHtml = `
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    ${course.image_url ? 
                                        `<img src="${course.image_url}" class="card-img-top lazy" alt="${course.title}">` 
                                        : ''}
                                    <div class="card-body">
                                        <h5 class="card-title">${course.title}</h5>
                                        ${course.is_new ? 
                                            '<span class="badge bg-success">新課程</span>' 
                                            : ''}
                                        <a href="/courses/${course.id}" class="btn btn-primary mt-2">查看詳情</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        courseContainer.append(courseHtml);
                    });
                }
            });
        });
    </script>
@endsection 