<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function preg_replace;

abstract class Sanitization
{
    public function sanitize($value): string
    {
        return empty($value) ? "" : preg_replace('/[^\d]/', '', $value);
    }
}
