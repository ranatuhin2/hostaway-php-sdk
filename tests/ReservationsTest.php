<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all reservations', function () {
     Http::fake([
          'https://api.hostaway.com/v1/reservations*' => Http::response([
               'reservations' => [
                    ['id' => 500, 'listingId' => 40160],
                    ['id' => 501, 'listingId' => 40161]
               ]
          ], 200),
     ]);

     $response = Hostaway::reservations()->getAll();

     expect($response['reservations'])->toHaveCount(2);
});

it('fetches single reservation by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/reservations/500' => Http::response([
               'id' => 500,
               'listingId' => 40160
          ], 200),
     ]);

     $response = Hostaway::reservations()->getById(500);

     expect($response)
          ->toHaveKey('id', 500)
          ->and($response['listingId'])->toBe(40160);
});
