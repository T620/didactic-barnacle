<?php

it('checks if a string is an anagram', function () {
    $anagram    = 'anna';
    $notAnagram = 'banana';

    $service = new Str();

    $this->assertTrue($service->isAnagram($anagram, 'anna'));
    $this->assertFalse($service->isAnagram($anagram, $notAnagram));
});

it('checks if a string is a palindrome', function () {
    $palindrome    = 'anna';
    $notPalindrome = 'banana';

    $service = new Str();

    $this->assertTrue($service->isPalindrome($palindrome));
    $this->assertFalse($service->isPalindrome($notPalindrome));
});

it('checks if a string is a pangram', function () {
    $pangram = 'The quick brown fox jumps over the lazy dog';

    $service = new Str();
    expect($service->isPangram($pangram))->toBeTrue();
});

