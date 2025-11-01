<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all users', function () {
     Http::fake([
          'https://api.hostaway.com/v1/users*' => Http::response([
               'users' => [
                    ['id' => 1, 'name' => 'John Doe'],
                    ['id' => 2, 'name' => 'Jane Doe']
               ]
          ], 200),
     ]);

     $response = Hostaway::users()->getAll();

     expect($response['users'])->toBeArray()->toHaveCount(2);
});

it('fetches single user by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/users/1' => Http::response([
               'id' => 1,
               'name' => 'John Doe'
          ], 200),
     ]);

     $response = Hostaway::users()->getById(1);

     expect($response)
          ->toHaveKey('id', 1)
          ->and($response['name'])->toBe('John Doe');
});
