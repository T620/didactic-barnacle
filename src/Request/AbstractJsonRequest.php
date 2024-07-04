<?php

declare(strict_types=1);

namespace App\Request;

use Jawira\CaseConverter\Convert;
use Exception;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Taken from https://github.com/joubertredrat/symfony-request-validation with thanks
 */
abstract class AbstractJsonRequest
{
    private const FORMAT_JSON = 'json';

    public function __construct(
        protected ValidatorInterface $validator,
        protected RequestStack $requestStack,
    ) {
        $this->populate();
        $this->validate();
    }

    public function getRequest(): Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    protected function populate(): void
    {
        $request = $this->getRequest();
        if (!self::isValidFormat($request)) {
            throw new RuntimeException('Expected application/json on header Content-Type request', 415);
        }

        $reflection = new ReflectionClass($this);

        foreach ($request->toArray() as $property => $value) {
            $attribute = self::camelCase($property);
            if (property_exists($this, $attribute)) {
                $reflectionProperty = $reflection->getProperty($attribute);
                $reflectionProperty->setValue($this, $value);
            }
        }
    }

    protected function validate(): void
    {
        $violations = $this->validator->validate($this);
        if (count($violations) < 1) {
            return;
        }

        $errors = [];

        /** @var \Symfony\Component\Validator\ConstraintViolation */
        foreach ($violations as $violation) {
            $errors[] = [
                'property' => self::snakeCase($violation->getPropertyPath()),
                'value' => $violation->getInvalidValue(),
                'message' => $violation->getMessage(),
            ];
        }

        throw new Exception($errors);
    }

    private static function isValidFormat(Request $request): bool
    {
        return \in_array($request->getContentTypeFormat(), self::getFormatsAvailable());
    }

    private static function getFormatsAvailable(): array
    {
        return [self::FORMAT_JSON];
    }

    private static function camelCase(string $attribute): string
    {
        return (new Convert($attribute))->toCamel();
    }

    private static function snakeCase(string $attribute): string
    {
        return (new Convert($attribute))->toSnake();
    }
}