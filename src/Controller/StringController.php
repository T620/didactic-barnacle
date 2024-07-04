<?php

namespace App\Controller;

use App\Helpers\Strings\Locales\En as Str;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StringController extends AbstractController
{
    /**
     * @throws JsonException
     */
    #[Route('api/v1/string/anagram', name: 'string.anagram', methods: ['POST'])]
    public function anagram(Str $stringService, Request $request): Response
    {
        // $request->get() doesn't work here :/
        $content    = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $phrase     = $content['phrase'] ?? '';
        $comparison = $content['comparison'] ?? '';

        if (empty($phrase) || empty($comparison)) {
            return new Response('Please provide both phrase and comparison parameters.', Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'phrase'     => $phrase,
            'comparison' => $comparison,
            'is_anagram' => $stringService->isAnagram($phrase, $comparison)
        ]);
    }

    /**
     * @throws JsonException
     */
    #[Route('api/v1/string/palindrome', name: 'string.palindrome', methods: ['POST'])]
    public function palindrome(Str $stringService, Request $request): Response
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $phrase  = $content['phrase'] ?? '';

        if (empty($phrase)) {
            return new Response('Please provide a phrase parameter.', Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'phrase'        => $phrase,
            'is_palindrome' => $stringService->isPalindrome($phrase)
        ]);
    }

    /**
     * @throws JsonException
     */
    #[Route('api/v1/string/pangram', name: 'string.pangram', methods: ['POST'])]
    public function pangram(Str $stringService, Request $request): Response
    {
        // todo: inject the correct locale based on session or query parameter
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $phrase  = $content['phrase'] ?? '';

        if (empty($phrase)) {
            return new Response('Please provide a phrase parameter.', Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'phrase'     => $phrase,
            'is_pangram' => $stringService->isPangram($phrase)
        ]);
    }
}
