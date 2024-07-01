<?php

namespace App\Application\Query\Handler;

use App\Application\Query\GetBookByIdQuery;
use App\Domain\Repository\BookRepositoryInterface;

class GetBookByIdHandler
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(GetBookByIdQuery $query)
    {
        return $this->bookRepository->findById($query->getBookId());
    }
}
