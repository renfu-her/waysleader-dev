<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $slug = 'home';

    protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
        redirect()->to('/backend/course-categories');
    }
}
