<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Book;

interface BookRepositoryInterface
{
    public function findAll(): array;
    public function findAllOrderedByName(): array;
    public function findByAuthor(string $author): array;
    public function findById(int $id): ?Book;
    public function save(Book $book): void;
    public function delete(Book $book): void;
}