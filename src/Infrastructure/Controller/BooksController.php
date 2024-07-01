<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CommandBus;
use App\Application\Command\ListBooksCommand;
use App\Application\Query\QueryBus;
use App\Application\Query\GetBookByIdQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    #[Route('/books', name: 'books_list')]
    public function listBooks(): Response
    {
        $parameter = 'some_value'; // Asegúrate de que este valor sea lo que necesites
        $command = new ListBooksCommand($parameter);
        $books = $this->commandBus->handle($command);

        return $this->render('books/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/books/{bookId}', name: 'books_get', requirements: ['bookId' => '\d+'])]
    public function getBookById(string $bookId): Response
    {
        $query = new GetBookByIdQuery($bookId);
        $book = $this->queryBus->handle($query);

        return $this->render('books/detail.html.twig', [
            'book' => $book,
        ]);
    }
}

