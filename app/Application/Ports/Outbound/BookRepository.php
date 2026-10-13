<?php

namespace App\Application\Ports\Outbound;

use App\Domain\Book;
use App\Domain\ValueObjects\Isbn;

interface BookRepository
{
    public function findById(string $id): ?Book;
    public function findByIsbn(Isbn $isbn): ?Book;
    public function save(Book $book): void;
    public function delete(string $id): void;
}