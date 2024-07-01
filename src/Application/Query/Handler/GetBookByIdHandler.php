<?php

namespace App\Application\Query\Handler;

use App\Application\Query\GetBookByIdQuery;
use App\Domain\Entity\Book; // Importa la entidad Book si no lo has hecho
use App\Domain\Repository\BookRepositoryInterface;

class GetBookByIdHandler
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param GetBookByIdQuery $query
     * @return Book|null
     * @throws \Exception When the book with the given ID is not found
     */
    public function handle(GetBookByIdQuery $query): ?Book
    {
        $book = $this->bookRepository->findById($query->getBookId());

        if (!$book) {
            throw new \Exception('Book not found');
        }

        return $book;
    }
}
