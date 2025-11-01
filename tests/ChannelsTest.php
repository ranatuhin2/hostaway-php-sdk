<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all channels', function () {
     Http::fake([
          'https://api.hostaway.com/v1/channels*' => Http::response([
               'channels' => [
                    ['id' => 1, 'name' => 'Airbnb'],
                    ['id' => 2, 'name' => 'Booking.com']
               ]
          ], 200),
     ]);

     $response = Hostaway::channels()->getAll();

     expect($response['channels'])->toHaveCount(2);
});

it('fetches single channel by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/channels/1' => Http::response([
               'id' => 1,
               'name' => 'Airbnb'
          ], 200),
     ]);

     $response = Hostaway::channels()->getById(1);

     expect($response['name'])->toBe('Airbnb');
});
