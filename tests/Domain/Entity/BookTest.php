<?php


namespace App\Domain\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Book;

class BookTest extends TestCase
{

    public function testSetAndGetName(): void
    {
        $book = new Book();
        $name = 'Test Book';

        $book->setName($name);
        $this->assertEquals($name, $book->getName());
    }

    public function testSetAndGetAuthor(): void
    {
        $book = new Book();
        $author = 'Test Author';

        $book->setAuthor($author);
        $this->assertEquals($author, $book->getAuthor());
    }

    public function testSetAndGetDescription(): void
    {
        $book = new Book();
        $description = 'Test Description';

        $book->setDescription($description);
        $this->assertEquals($description, $book->getDescription());
    }
}
