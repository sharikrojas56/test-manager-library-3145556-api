<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

final class Quantity
{
    private int $value;

    public function __construct(int $quantity)
    {
        if ($quantity < 0) {
            throw new InvalidArgumentException('Quantity cannot be negative');
        }
        
        $this->value = $quantity;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function add(self $other): self
    {
        return new self($this->value + $other->value);
    }

    public function subtract(self $other): self
    {
        $result = $this->value - $other->value;
        if ($result < 0) {
            throw new InvalidArgumentException('Result cannot be negative');
        }
        
        return new self($result);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function isGreaterThan(self $other): bool
    {
        return $this->value > $other->value;
    }

    public function isZero(): bool
    {
        return $this->value === 0;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}