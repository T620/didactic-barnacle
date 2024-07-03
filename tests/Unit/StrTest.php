<?php


use App\Helpers\Strings\Locales\En as Str;
use App\Helpers\Strings\Locales\It as ItalianStr;

beforeEach(function () {
    $this->service        = new Str();
    $this->italianService = new ItalianStr();
});

it('checks for palindromes when given', function (string $subject, bool $result) {
    expect($this->service->isPalindrome($subject))->toBe($result);
})->with([
    'Anna'                           => ['anna', true],
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
        expect($this->service->isAnagram($subject, $comparison))->toBe($result);
    })->with([
    'glean'                                                        => ['glean', 'angel', true],
    'listen'                                                       => ['listen', 'silent', true],
    'a sequence of numbers'                                        => ['1337', '7331', true],
    'another sequence of numbers'                                  => ['9009', '90091', false],
    'a phrase with randomly repeated capitalisation'               => ['thE eyEs', 'they see', true],
    'another phrase'                                               => [
        'Why of course you can, old sport', 'The Great Gatsby', false
    ],
    'a phrase that is really close to being an anagram but isn\'t' => ['thee eyes', 'they see', false],
    'another anagram'                                              => ['coalface', 'cacao elf', true],
    'another prhase that isn\'t an anagram'                        => ['coalface', 'dark elf', false],
]);

it('checks for pangrams when given', function (string $phrase, bool $result) {
    expect($this->service->isPangram($phrase))->toBe($result);
})->with([
    'an actual angram'               => ['A wizard’s job is to vex chumps quickly in fog.', true],
    'another angram'                 => ['The quick brown fox jumps over the lazy dog', true],
    'a phrase that isn\'t an angram' => [
        'The British Broadcasting Corporation (BBC) is a British public service broadcaster.', false
    ],
    'a random phrase'                => [
        'The problem with having an open mind is that people insist on putting things inside of it', false
    ]
]);


// if you're curious, "O templi, quarzi, vigne, fidi boschi" means "Oh temples, quartz, vineyards, faithful woods!". Lovely.
it('checks for italian pangrams when given', function (string $word, bool $result) {
    expect($this->italianService->isPangram($word))->toBe($result);
})->with([
    'an italian pangram'      => ['O templi, quarzi, vigne, fidi boschi!', true],
    'a random italian phrase' => ['Buenanotte, mio amore!', false]
]);
