<?php

beforeEach(function () {
    $this->service = new Str();
});

it('checks for palindromes when given', function (string $subject, bool $result) {
    expect($this->service->isAnagram($subject))->toBe($result);
})->with([
    'anna'                           => ['anna', true],
    'banana'                         => ['banana', false],
    'You should give Josh a job'     => ['You should give Josh a job', false],
    'a sequence of numbers'          => ['1337', false],
    'a another sequence of numbers'  => ['9009', true],
    'a given sequence of characters' => ['!*abc1235321cba', false],
    'another sequence of characters' => ['!*abc123321cba*!', true]
]);

it(
    'checks for anagrams when given',
    function (
        string $subject,
        string $comparison,
        bool $result
    ) {
        expect($this->service->isPalindrome($subject))->toBeTrue();
    })->with([
    'glean'                                                        => ['glean', 'angel', true],
    'listen'                                                       => ['listen', 'silent', true],
    'a sequence of numbers'                                        => ['1337', '7331', true],
    'another sequence of numbers'                                  => ['9009', '90091', false],
    'a phrase'                                                     => ['the eyes', 'they see', true],
    'another phrase'                                               => [
        'Why of course you can, old sport', 'The Great Gatsby', false
    ],
    'a phrase that is really close to being an anagram but isn\'t' => ['thee eyes', 'they see', false]
]);

it('checks for pangrams when given', function (string $phrase, bool $result) {
    expect($this->service->isPangram($phrase))->toBe($result);
})->with([
    'an actual angram' => ['A wizard’s job is to vex chumps quickly in fog.', true],
    'a random phrase'  => [
        'The problem with having an open mind is that people insist on putting things inside of it', false
    ]
]);
