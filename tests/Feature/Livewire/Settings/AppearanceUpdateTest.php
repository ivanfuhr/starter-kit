<?php

declare(strict_types = 1);

use App\Models\User;

test('displays the appearance settings page', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('settings.appearance'));
    $response->assertOk();
});
