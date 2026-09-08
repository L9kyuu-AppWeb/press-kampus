<?php

use App\Models\User;

test('admin dapat melihat daftar pengguna', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->count(3)->create();

    $response = $this->actingAs($admin)->get(route('admin.users.index'));

    $response->assertOk()->assertViewIs('admin.users.index');
});

test('user biasa tidak dapat mengakses manajemen pengguna', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.users.index'));

    $response->assertForbidden();
});

test('tamu tidak dapat mengakses manajemen pengguna', function () {
    $response = $this->get(route('admin.users.index'));

    $response->assertRedirect(route('login'));
});

test('admin dapat membuat pengguna baru', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'Baru Test',
        'email' => 'baru@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'user',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', ['email' => 'baru@example.com', 'role' => 'user']);
});

test('admin dapat membuat pengguna dengan role admin', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'Admin Baru',
        'email' => 'adminbaru@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'admin',
    ]);

    $this->assertDatabaseHas('users', ['email' => 'adminbaru@example.com', 'role' => 'admin']);
});

test('admin dapat mengupdate pengguna', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['name' => 'Lama']);

    $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
        'name' => 'Baru',
        'email' => $user->email,
        'role' => 'admin',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Baru', 'role' => 'admin']);
});

test('admin dapat menghapus pengguna', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user));

    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

test('admin tidak dapat menghapus akun sendiri', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $admin));

    $this->assertDatabaseHas('users', ['id' => $admin->id]);
});

test('validasi store: email harus unik', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->create(['email' => 'dup@example.com']);

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'Test',
        'email' => 'dup@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'user',
    ]);

    $response->assertSessionHasErrors('email');
});

test('validasi store: role harus admin atau user', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'Test',
        'email' => 'test2@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'superadmin',
    ]);

    $response->assertSessionHasErrors('role');
});
