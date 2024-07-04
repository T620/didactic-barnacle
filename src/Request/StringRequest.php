<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class StringRequest extends Request
{
    // not empty
    #[Type('string')]
    #[NotBlank (message: 'Please provide a word or phrase')]
    public string $phrase = '';

    // string
    #[Type('string')]
    // TODO: conditional validation or separate validators
    public string $comparison = '';

    public function __construct(Request $request)
    {
        parent::__construct();

        $data = json_decode($request->getContent(), true);

        if (isset($data['phrase'])) {
            $this->phrase = $data['phrase'];
        }

        if (isset($data['comparison'])) {
            $this->comparison = $data['comparison'];
        }
    }

}