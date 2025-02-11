<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings->site_name ?? '科普班長' }}</title>

    @if ($siteSettings->site_favicon)
        <link rel="icon" type="image/png" href="{{ $siteSettings->site_favicon }}">
    @endif

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.lazy@1.7.11/jquery.lazy.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">
                @if ($siteSettings->site_logo)
                    <img src="{{ $siteSettings->site_logo }}" alt="{{ $siteSettings->site_name }}" height="40">
                @else
                    {{ $siteSettings->site_name }}
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            關於科普
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pages.show', 'about') }}">簡介</a></li>
                            <li><a class="dropdown-item" href="{{ route('pages.show', 'contact') }}">與我聯繫</a></li>
                            <li><a class="dropdown-item" href="{{ route('faqs.index') }}">Q&A</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            課程教學
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pages.show', 'features') }}">課程特色</a></li>
                            <li><a class="dropdown-item" href="{{ route('courses.index') }}">課程分級</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">成果展示</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script>
        $(function() {
            $('.lazy').Lazy();
        });
    </script>
</body>

</html>
