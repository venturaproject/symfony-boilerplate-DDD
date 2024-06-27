<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bookNames = [
            'Book One', 'Book Two', 'Book Three', 'Book Four', 'Book Five',
            'Book Six', 'Book Seven', 'Book Eight', 'Book Nine', 'Book Ten',
            'Book Eleven', 'Book Twelve', 'Book Thirteen', 'Book Fourteen', 'Book Fifteen',
            'Book Sixteen', 'Book Seventeen', 'Book Eighteen', 'Book Nineteen', 'Book Twenty'
        ];

        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setName($bookNames[$i]);
            $book->setAuthor('Author ' . ($i + 1));
            $book->setDescription('Description for ' . $bookNames[$i]);

            $manager->persist($book);
            echo "Persisted Book " . ($i + 1) . "\n"; // Mensaje de depuración
        }

        $manager->flush();
        echo "Flushed all books\n"; // Mensaje de depuración
    }
}