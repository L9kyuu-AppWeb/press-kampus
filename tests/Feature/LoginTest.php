<?php

use App\Models\User;

test('guest dapat melihat halaman login', function () {
    $response = $this->get(route('login'));

    $response->assertOk()->assertViewIs('auth.login');
});

test('guest berhasil login dan diarahkan ke dashboard', function () {
    $user = User::factory()->create(['password' => bcrypt('password123')]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
});

test('login gagal dengan password salah', function () {
    $user = User::factory()->create();

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'salah',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('dashboard dapat diakses setelah login', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk()->assertViewIs('admin.dashboard');
});

test('dashboard tidak dapat diakses oleh tamu', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect(route('login'));
});

test('user dapat logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('login'));
    $this->assertGuest();
});

test('role admin dapat dikenali', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    expect($admin->isAdmin())->toBeTrue()
        ->and($user->isAdmin())->toBeFalse();
});
