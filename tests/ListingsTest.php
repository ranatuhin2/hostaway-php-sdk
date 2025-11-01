<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all listings successfully', function () {
     Http::fake([
          'https://api.hostaway.com/v1/listings*' => Http::response([
               'result' => 'ok',
               'listings' => [
                    ['id' => 40160, 'name' => 'Beach Villa'],
                    ['id' => 40161, 'name' => 'Mountain Cabin']
               ],
          ], 200),
     ]);

     $response = Hostaway::listings()->getAll();

     expect($response)
          ->toHaveKey('listings')
          ->and($response['listings'])->toBeArray()
          ->and($response['result'])->toBe('ok');
});

it('fetches a single listing by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/listings/40160' => Http::response([
               'id' => 40160,
               'name' => 'Beach Villa'
          ], 200),
     ]);

     $response = Hostaway::listings()->getById(40160);

     expect($response)
          ->toHaveKey('id', 40160)
          ->and($response['name'])->toBe('Beach Villa');
});
