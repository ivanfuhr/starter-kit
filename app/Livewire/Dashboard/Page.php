<?php

declare(strict_types = 1);

namespace App\Livewire\Dashboard;

use Illuminate\View\View;
use Livewire\Component;

final class Page extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard.page');
    }
}
