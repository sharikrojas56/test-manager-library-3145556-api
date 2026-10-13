<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

final class Isbn
{
    private string $value;

    public function __construct(string $isbn)
    {
        $cleanIsbn = preg_replace('/[^0-9]/', '', $isbn);
        
        if (strlen($cleanIsbn) !== 13) {
            throw new InvalidArgumentException('ISBN must be 13 digits');
        }
        
        if (!ctype_digit($cleanIsbn)) {
            throw new InvalidArgumentException('ISBN must contain only digits');
        }
        
        $this->value = $cleanIsbn;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}