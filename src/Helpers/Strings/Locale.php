<?php

namespace App\Helpers\Strings;

use App\Helpers\CheckerInterface;

/**
 * Class Str
 * I may or may not have borrowed the name from Laravel
 */
abstract class Locale implements CheckerInterface
{
    use UniquesStrings;

    /**
     * @inheriDoc
     */
    public function isPalindrome(string $word): bool
    {
        // reverse the word and return an equality check
        return strrev(strtolower($word)) === strtolower($word);
    }

    /**
     * @inheriDoc
     * @see https://www.php.net/manual/en/function.count-chars.php
     * @see https://en.wikipedia.org/wiki/Anagram
     */
    public function isAnagram(string $word, string $comparison): bool
    {
        /**
         * Compare the character count of the two words. This will
         * ensure that each letter in the original word is used exactly once, including
         * repeated instances of the same letter.
         *
         * use count_chars to handle this for us, with the mode of 1 to only list byte-values
         * with a frequency greater than zero. This will automatically omit any characters that are not present in the word and produce extra validation without
         * any extra effort. It doesn't however account for spaces or case sensitivity, so we need to handle those first.
         *
         * Note: I would argue the interface's method description is misleading,
         * because it doesn't cover words that have the same letters but different frequencies
         * I've implemented the method to check for anagrams in the traditional sense
         * and referenced this actual definition online: https://en.wikipedia.org/wiki/Anagram
         */

        $word       = str_replace(' ', '', strtolower($word));
        $comparison = str_replace(' ', '', strtolower($comparison));

        return count_chars($word, 1) === count_chars($comparison, 1);
    }

    /**
     * @inheritDoc
     * Each Language will have a different number of letters in its alphabet
     * but the logic is the same. I've made this method abstract so that each locale can define the number of letters in its alphabet
     * while having the main, repeated logic inside a trait, so it can be reused across all locales
     */
    abstract public function isPangram(string $phrase): bool;

    /*
     * I've made this method abstract so that each locale can define the number of letters in its alphabet
     * without having to worry about conflicting property names (e.g. $lettersInAlphabet
     * for both en/it would cause an error) and to ensure that the method is implemented in each locale
     * so we can guarantee that the method is available to call
     */
    abstract public static function lettersInAlphabet(): int;
}