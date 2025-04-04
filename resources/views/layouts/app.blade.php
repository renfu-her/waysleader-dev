<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $siteSettings->seo_description }}">
    <meta name="keywords" content="{{ $siteSettings->seo_keywords }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings->site_name }}</title>

    @if ($siteSettings->site_favicon)
        <link rel="shortcut icon" href="{{ $siteSettings->site_favicon }}">
    @endif

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors/grape.css') }}">
    <link rel="preload" href="{{ asset('assets/css/fonts/space.css') }}" as="style" onload="this.rel='stylesheet'">

    @yield('styles')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.lazy@1.7.11/jquery.lazy.min.js"></script>
</head>

<body class="bg-soft-primary">
    <div class="content-wrapper">
        <header class="position-absolute w-100">
            <nav class="navbar navbar-expand-lg center-nav navbar-light bg-white">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                        <a href="/">
                            @if ($siteSettings->site_logo)
                                <img src="{{ $siteSettings->site_logo }}" alt="{{ $siteSettings->site_name }}"
                                    height="40">
                            @else
                                {{ $siteSettings->site_name }}
                            @endif
                        </a>
                    </div>

                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto" style="padding-right: 15px;">
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                                    <span></span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0">{{ $siteSettings->site_name }}</h3>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">關於科普</a>
                                    <ul class="dropdown-menu">
                                        @if (\App\Models\Menu::where('name', '簡介')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('pages.show', 'about') }}">簡介</a></li>
                                        @endif
                                        @if (\App\Models\Menu::where('name', '團隊師資')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item" href="{{ route('teachers.index') }}">團隊師資</a>
                                            </li>
                                        @endif
                                        @if (\App\Models\Menu::where('name', '與我聯繫')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('pages.show', 'contact') }}">與我聯繫</a></li>
                                        @endif
                                        @if (\App\Models\Menu::where('name', 'Q&A')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item" href="{{ route('faqs.index') }}">Q&A</a></li>
                                        @endif
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">課程教學</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($coursePages as $page)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                                            </li>
                                        @endforeach
                                        @if (\App\Models\Menu::where('name', '課程分級')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item" href="{{ route('courses.index') }}">課程分級</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">成果展示</a>
                                    <ul class="dropdown-menu">
                                        @if (\App\Models\Menu::where('name', '創意展示')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('achievements.category', 'creative') }}">創意展示</a>
                                            </li>
                                        @endif
                                        @if (\App\Models\Menu::where('name', '成果分享')->where('is_active', true)->exists())
                                            <li><a class="dropdown-item"
                                                    href="{{ route('achievements.category', 'sharing') }}">成果分享</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="bg-dark text-inverse">
            <div class="container py-13 py-md-15">
                <div class="row gy-6 gy-lg-0">
                    <div class="col-lg-4">
                        <div class="widget">
                            <h3 class="h2 mb-3 text-white">{{ $siteSettings->site_name }}</h3>
                            <p class="mb-5">{{ $siteSettings->seo_description }}</p>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title text-white mb-3">快速連結</h4>
                            <ul class="list-unstyled text-reset mb-0">
                                @if (\App\Models\Menu::where('name', '簡介')->where('is_active', true)->exists())
                                    <li><a href="{{ route('pages.show', 'about') }}">簡介</a></li>
                                @endif
                                @if (\App\Models\Menu::where('name', '團隊師資')->where('is_active', true)->exists())
                                    <li><a href="{{ route('teachers.index') }}">團隊師資</a></li>
                                @endif
                                @if (\App\Models\Menu::where('name', '與我聯繫')->where('is_active', true)->exists())
                                    <li><a href="{{ route('pages.show', 'contact') }}">與我聯繫</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title text-white mb-3">課程資訊</h4>
                            <ul class="list-unstyled text-reset mb-0">
                                @if (\App\Models\Menu::where('name', '課程分級')->where('is_active', true)->exists())
                                    <li><a href="{{ route('courses.index') }}">課程分級</a></li>
                                @endif
                                @if (\App\Models\Menu::where('name', '創意展示')->where('is_active', true)->exists())
                                    <li><a href="{{ route('achievements.category', 'creative') }}">創意展示</a></li>
                                @endif
                                @if (\App\Models\Menu::where('name', '成果分享')->where('is_active', true)->exists())
                                    <li><a href="{{ route('achievements.category', 'sharing') }}">成果分享</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="widget">
                            <h4 class="widget-title text-white mb-3">聯絡資訊</h4>
                            <address class="pe-xl-5 pe-xxl-8">
                                <p class="mb-2">{{ $siteSettings->address }}</p>
                                <p class="mb-2">電話：{{ $siteSettings->contact_phone }}</p>
                                <p class="mb-2">Email：{{ $siteSettings->contact_email }}</p>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        $(function() {
            $('.lazy').Lazy();
        });
    </script>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    @yield('scripts')

</body>

</html>
