<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches calendar for a listing', function () {
     Http::fake([
          'https://api.hostaway.com/v1/listings/40160/calendar' => Http::response([
               'days' => [
                    ['date' => '2025-11-01', 'available' => true],
                    ['date' => '2025-11-02', 'available' => false]
               ]
          ], 200),
     ]);

     $response = Hostaway::calendar()->getByListing(40160);

     expect($response['days'])->toBeArray()->toHaveCount(2);
});
