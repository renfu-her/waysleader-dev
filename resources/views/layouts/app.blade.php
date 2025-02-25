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
                                        <li><a class="dropdown-item" href="{{ route('pages.show', 'about') }}">簡介</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('teachers.index') }}">團隊師資</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('pages.show', 'contact') }}">與我聯繫</a></li>
                                        <li><a class="dropdown-item" href="{{ route('faqs.index') }}">Q&A</a></li>

                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">課程教學</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('pages.show', 'features') }}">課程特色</a></li>
                                        <li><a class="dropdown-item" href="{{ route('courses.index') }}">課程分級</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-bs-toggle="dropdown">成果展示</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('achievements.category', 'creative') }}">創意展示</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('achievements.category', 'sharing') }}">成果分享</a>
                                        </li>
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
