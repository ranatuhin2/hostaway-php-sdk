<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Facades\Hostaway;

it('fetches all tasks', function () {
     Http::fake([
          'https://api.hostaway.com/v1/tasks*' => Http::response([
               'tasks' => [
                    ['id' => 900, 'title' => 'Clean Room'],
                    ['id' => 901, 'title' => 'Check Supplies']
               ]
          ], 200),
     ]);

     $response = Hostaway::tasks()->getAll();

     expect($response['tasks'])->toHaveCount(2);
});

it('fetches single task by id', function () {
     Http::fake([
          'https://api.hostaway.com/v1/tasks/900' => Http::response([
               'id' => 900,
               'title' => 'Clean Room'
          ], 200),
     ]);

     $response = Hostaway::tasks()->getById(900);

     expect($response)
          ->toHaveKey('id', 900)
          ->and($response['title'])->toBe('Clean Room');
});
