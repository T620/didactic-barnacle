<?php

namespace App\Helpers;

//use App\Traits\HandlesItalianAlphabet;

/**
 * Class Str
 * I may or may not have borrowed the name from Laravel
 */
class Str implements CheckerInterface
{
    private static $lettersInAlphabet = 26;

    // just for fun
//    use HandlesItalianAlphabet;

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
         * any extra effort.
         *
         * Note: I would argue the interface's method description is misleading,
         * because it doesn't cover words that have the same letters but different frequencies
         * I've implemented the method to check for anagrams in the traditional sense
         * and referenced this actual definition online: https://en.wikipedia.org/wiki/Anagram
         */
        return count_chars(strtolower($word), 1) === count_chars(strtolower($comparison), 1);
    }

    /**
     * @inheriDoc
     */
    public function isPangram(string $phrase): bool
    {
        /*
         * We could define the alphabet as a string and use str_split to convert it to an array
         * but we know for certainty that the alphabet will always be the same, so we can just
         * check its length and ensure the phrase contains all the letters via array_unique
         */

        // we will need to format the phrase to remove any non-alphabetic characters
        // so, we'll use a regular expression pattern to match only letters
        $pattern  = '/[^a-z]/i'; // a-z, /i = case-insensitive

        // remove any non-alphabetic characters
        $phrase = preg_replace($pattern, '', $phrase);

        // now we've removed the letters, we can check if the phrase contains all the letters
        // convert to an array and check the length
        $unique = array_unique(str_split(strtolower($phrase)));

        return count($unique) === self::$lengthOfEnglishAlphabet;
    }
}