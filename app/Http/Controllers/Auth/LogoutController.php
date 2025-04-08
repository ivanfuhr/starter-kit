<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportRedirects\Redirector;

final class LogoutController
{
    public function __invoke(): RedirectResponse | Redirector
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        /** @var Redirector|RedirectResponse */
        return redirect('/');
    }
}
