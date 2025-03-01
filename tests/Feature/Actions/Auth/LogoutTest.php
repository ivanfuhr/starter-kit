<?php

declare(strict_types = 1);

use App\Actions\Auth\Logout;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\actingAs;

uses()->group('auth');

it('logs out the user, invalidates session, and redirects', function (): void {
    $user = User::factory()->create();
    actingAs($user);

    Auth::shouldReceive('guard')->with('web')->andReturnSelf();
    Auth::shouldReceive('logout')->once();

    Session::spy();

    $action   = new Logout();
    $response = $action->handle();

    Session::shouldHaveReceived('invalidate')->once();
    Session::shouldHaveReceived('regenerateToken')->once();

    expect($response)->toBeInstanceOf(RedirectResponse::class)
        ->and($response->getTargetUrl())->toBe(url('/'));
});
