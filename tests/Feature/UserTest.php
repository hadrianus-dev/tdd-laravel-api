<?php

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;

// USER GET

test('shoud return status 200 if route exists', function () {
    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(200);
});

test('shoud return status 500 if something goes wrong when called', function () {
    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(500);
});

test('shoud return status 401 when a guest user try to get users', function () {
    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(401);
});

test('shoud return status 200 when a authenticated user get users', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(200);
    expect($response)->toBeObject();
    $this->assertDatabaseHas('users', ['email' => $user->email]);
});

test('shoud return status 200 when get only user', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $response = $this->getJson("/api/v1/user/{$user->id}");
    $response->assertStatus(200);
    expect($response)->toBeObject();
})->only();

// USER POST

test('shoud return status 422 when dont send parameters or missing parameters', function () {
    $response = $this->postJson('/api/v1/user');
    $response->assertStatus(422);
});

test('shoud return status 401 when a guest user try to create user', function () {
    $data = [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
    $response = $this->postJson('/api/v1/user', $data);
    $response->assertStatus(401);
    $this->assertDatabaseCount('users', 0);
});

test('shoud return status 201 when a authenticated user to create user', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $data = [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
    $response = $this->postJson('/api/v1/user', $data);
    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['email' => $data['email']]);
});


