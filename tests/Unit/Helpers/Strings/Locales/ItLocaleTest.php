<?php

use App\Helpers\Strings\Locales\It as ItalianStr;

beforeEach(function () {
    $this->service = new ItalianStr();
});

// if you're curious, "O templi, quarzi, vigne, fidi boschi" means "Oh temples, quartz, vineyards, faithful woods!". Lovely.
it('checks for italian pangrams when given', function (string $word, bool $result) {
    expect($this->service->isPangram($word))->toBe($result);
})->with([
    'an italian pangram'      => ['O templi, quarzi, vigne, fidi boschi!', true],
    'a random italian phrase' => ['Buenanotte, mio amore!', false]
]);