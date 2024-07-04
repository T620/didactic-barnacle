<?php

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

beforeEach(function () {
    $this->host = sprintf(
        'https://%s:%s',
        $_ENV['API_HOST'] ?? 'localhost',
        $_ENV['API_PORT'] ?? 443
    );

    $this->client = HttpClient::create();
});

test('example', function () {
    expect(true)->toBeTrue();
});

it('returns true when I ask for an anagram of a phrase', function () {
    $body = json_encode([
        'phrase'     => 'listen',
        'comparison' => 'silent'
    ]);

    $response = $this->client->request('POST', 'http://0.0.0.0:88/api/v1/string/anagram', [
        'body' => $body
    ]);

    $response->assertJson([
        'phrase'     => 'listen',
        'comparison' => 'silent',
        'is_anagram' => true
    ]);
});

// todo: future tests for other endpoints
