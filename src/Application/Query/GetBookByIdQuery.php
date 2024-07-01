<?php

namespace App\Application\Query;

class GetBookByIdQuery
{
    private $bookId;

    public function __construct(string $bookId)
    {
        $this->bookId = $bookId;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }
}
