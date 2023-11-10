<?php

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\User\Index;
use App\Http\Controllers\Api\User\Create;
use Illuminate\Testing\Fluent\AssertableJson;

// USER GET

test('shoud return status 401 when a guest user try to get users', function () {
    $this->getJson(
        uri: action(Index::class),
    )->assertStatus(
        status: 401,
    );
});

test('shoud return status 200 when a authenticated user get users', function () {
    $user = User::factory()->create();
    $this->actingAs(User::factory()->create())->getJson(
        uri: action(Index::class),
    )->assertStatus(
        status: 200,
    )->assertJson(
        function (AssertableJson $json) use($user) {
            $json->has(User::count())->first(
                function (AssertableJson $json) use($user){
                    $json->where('email', $user->email)->etc();
                }
            );
        }
    );
});

test('shoud return status 200 when get only user', function () {
    $user = User::factory()->create();
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1usershow', $user->id)
    )->assertStatus(
        status: 200,
    )->assertJson(
        function (AssertableJson $json) use($user) {
            $json->where('email', $user->email)->etc();
        }
    );
})->only();

// USER POST

test('shoud return status 401 when a guest user try to create user', function () {
    $this->postJson(
            uri: action(Create::class),
        )->assertStatus(
            status: 401,
        );
    $this->assertDatabaseCount('users', 0);
});

test('shoud return status 422 when dont send parameters or missing parameters', function () {
    $this->actingAs(User::factory()->create())->postJson(
            uri: action(Create::class),
        )->assertStatus(
            status: 422,
        );
});

test('shoud return status 201 when a authenticated user to create user', function () {
    $data = [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
    $this->actingAs(User::factory()->create())->postJson(
        '/api/v1/user', $data
    )->assertStatus(
        status: 201,
    );
    $this->assertDatabaseHas('users', ['email' => $data['email']]);
});


