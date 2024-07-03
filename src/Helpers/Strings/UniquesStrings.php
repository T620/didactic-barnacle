<?php

namespace App\Helpers\Strings;

trait UniquesStrings
{
    public function toUnique(string $phrase): array
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
        return array_unique(str_split(strtolower($phrase)));
    }
}
