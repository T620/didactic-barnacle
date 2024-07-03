<?php

namespace App\Helpers\Strings\Locales;

use App\Helpers\Strings\Locale;

class En extends Locale
{
    public static function lettersInAlphabet(): int
    {
        return 26;
    }

    public function isPangram(string $phrase): bool
    {
        $unique = $this->toUnique($phrase);

        return count($unique) === self::lettersInAlphabet();
    }
}