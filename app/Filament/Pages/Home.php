<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $slug = 'home';

    protected static bool $shouldRegisterNavigation = false;

    public function index()
    {
        return redirect()->route('filament.backend.resources.course-categories.index');
    }
}
