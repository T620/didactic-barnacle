<?php

namespace App\Helpers\Strings\Locales;

use App\Helpers\Strings\Locale;

class It extends Locale
{
    /**
     * By using a method I can customise the value per class
     * while still having a consistently named accessor (enforced via the abstract method in Locale)
     * Bit overkill for just an int though
     * @return int
     */
    public static function lettersInAlphabet(): int
    {
        return 21; // according to my Italian girlfriend, who knew?!
    }

    /**
     * @inheritDoc
     */
    public function isPangram(string $phrase): bool
    {
        $unique = $this->toUnique($phrase);

        // now we've removed the letters, we can check if the phrase contains all the letters
        // convert to an array and check the length
        return count($unique) === self::lettersInAlphabet();
    }
}