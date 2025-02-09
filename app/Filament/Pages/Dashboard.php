<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Redirect;
use App\Filament\Resources\PostResource;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = 'posts';

    protected static ?string $navigationLabel = '文章管理';

    protected static ?string $title = '文章管理';

    public function mount(): void
    {
        $this->redirect(PostResource::getUrl());
    }

    public function getTitle(): string|Htmlable
    {
        return '文章管理';
    }
}
