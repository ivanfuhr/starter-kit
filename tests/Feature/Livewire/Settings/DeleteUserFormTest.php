<?php

declare(strict_types = 1);

use App\Livewire\Settings\Profile\DeleteUserForm;
use App\Models\User;
use Livewire\Livewire;

test('deletes the user account successfully', function (): void {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser')
        ->assertRedirect(route('logout', absolute: false));

    expect(User::find($user->id))->toBeNull();
});

test('fails to delete account with incorrect password', function (): void {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(DeleteUserForm::class)
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password' => ['current_password']]);

    expect(User::find($user->id))->not()->toBeNull();
});

test('fails to delete account when password is missing', function (): void {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(DeleteUserForm::class)
        ->call('deleteUser')
        ->assertHasErrors(['password' => ['required']]);

    expect(User::find($user->id))->not()->toBeNull();
});
