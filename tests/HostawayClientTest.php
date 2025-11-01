<?php

use RanaTuhin\Hostaway\Facades\Hostaway;

it('can create a valid HostawayClient instance', function () {
     $client = app()->make(\RanaTuhin\Hostaway\HostawayClient::class);

     expect($client)->toBeInstanceOf(\RanaTuhin\Hostaway\HostawayClient::class);
});

it('throws an exception when authentication fails', function () {
     // Mock invalid credentials
     config()->set('hostaway.client_id', 'invalid');
     config()->set('hostaway.client_secret', 'invalid');

     $client = new \RanaTuhin\Hostaway\HostawayClient();

     $this->expectException(\RanaTuhin\Hostaway\Exceptions\AuthenticationException::class);

     $client->authenticate();
});
