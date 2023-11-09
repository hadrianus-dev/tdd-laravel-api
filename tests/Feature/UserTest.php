<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('shoud return status 200 if route exists', function () {
    $response = $this->get('/api/v1/user');
    $response->assertStatus(200);
});

test('shoud return status 200 and an object when called', function () {
    $response = $this->get('/api/v1/user');
    $response->assertStatus(200);
    expect($response)->toBeObject();
});

test('shoud return status 500 if something goes wrong when called', function () {
    $response = $this->get('/api/v1/user');
    $response->assertStatus(500);
})->only();
