<?php

use Illuminate\Support\Facades\Http;
use RanaTuhin\HostawayPhpSdk\Helpers\RequestHelper;
use RanaTuhin\HostawayPhpSdk\Exceptions\RequestFailedException;
use RanaTuhin\HostawayPhpSdk\Exceptions\AuthenticationException;

beforeEach(function () {
     $this->helper = new RequestHelper('fake-access-token');
});

it('returns json on successful response', function () {
     Http::fake([
          'https://api.hostaway.com/*' => Http::response(['success' => true], 200),
     ]);

     $response = $this->helper->get('https://api.hostaway.com/v1/listings');

     expect($response)->toBeArray()
          ->and($response['success'])->toBeTrue();
});

it('throws AuthenticationException on 401 response', function () {
     Http::fake([
          'https://api.hostaway.com/*' => Http::response(['error' => 'Unauthorized'], 401),
     ]);

     $this->helper->get('https://api.hostaway.com/v1/listings');
})->throws(AuthenticationException::class);

it('throws RequestFailedException on 500 response', function () {
     Http::fake([
          'https://api.hostaway.com/*' => Http::response(['error' => 'Internal Server Error'], 500),
     ]);

     $this->helper->get('https://api.hostaway.com/v1/listings');
})->throws(RequestFailedException::class);
