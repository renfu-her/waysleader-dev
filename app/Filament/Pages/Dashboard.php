<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Redirect;
use App\Filament\Resources\PostResource;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = '主頁';

    protected static ?string $title = '主頁';

    public function mount(): void
    {
        redirect('/backend/posts');
    }

    public function getTitle(): string|Htmlable
    {
        return '主頁';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
