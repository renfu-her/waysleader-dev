<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\RedirectResponse;

class Home extends Page
{
    protected static ?string $slug = 'home';

    protected static bool $shouldRegisterNavigation = false;

    public function mount(): RedirectResponse
    {
        return redirect()->route('filament.backend.resources.course-categories.index');
    }
}
