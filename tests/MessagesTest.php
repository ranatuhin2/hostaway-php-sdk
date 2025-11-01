<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all messages', function () {
     Http::fake([
          'https://api.hostaway.com/v1/messages*' => Http::response([
               'messages' => [
                    ['id' => 100, 'body' => 'Hi'],
                    ['id' => 101, 'body' => 'Welcome!']
               ]
          ], 200),
     ]);

     $response = Hostaway::messages()->getAll();

     expect($response['messages'])->toHaveCount(2);
});

it('fetches single message by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/messages/100' => Http::response([
               'id' => 100,
               'body' => 'Hi there'
          ], 200),
     ]);

     $response = Hostaway::messages()->getById(100);

     expect($response['id'])->toBe(100)
          ->and($response['body'])->toBe('Hi there');
});
