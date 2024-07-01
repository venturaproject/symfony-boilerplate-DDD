<?php

namespace App\Application\Command\Handler;

use App\Application\Command\ListBooksCommand;
use App\Domain\Repository\BookRepositoryInterface;

class ListBooksHandler
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(ListBooksCommand $command)
    {
        $parameter = $command->getParameter();
        // Usa el parámetro según sea necesario
        return $this->bookRepository->findAll(); // O ajusta esto para usar el parámetro
    }
}
