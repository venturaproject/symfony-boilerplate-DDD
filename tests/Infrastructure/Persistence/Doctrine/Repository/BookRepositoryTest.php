<?php
namespace App\Tests\Infrastructure\Persistence\Doctrine\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Book;
use App\Infrastructure\Persistence\Doctrine\Repository\BookRepository;

class BookRepositoryTest extends KernelTestCase
{
    private $entityManager;
    private $bookRepository;

    protected function setUp(): void
    {
        // Inicializa el kernel de Symfony
        self::bootKernel();

        // Obtiene el contenedor de servicios
        $container = static::getContainer();

        // Obtiene el EntityManager
        $this->entityManager = $container->get('doctrine')->getManager();

        // Obtiene el repositorio de libros
        $this->bookRepository = $this->entityManager->getRepository(Book::class);
    }

    public function testFindAll()
    {
        $books = $this->bookRepository->findAll();

        // Asegura que se encontraron algunos libros
        $this->assertNotEmpty($books);
    }

    public function testFindAllOrderedByName()
    {
        $books = $this->bookRepository->findAllOrderedByName();

        // Asegura que se encontraron algunos libros
        $this->assertNotEmpty($books);

        // Asegura que los libros están ordenados por nombre
        $previousName = null;
        foreach ($books as $book) {
            if ($previousName !== null) {
                $this->assertGreaterThanOrEqual($previousName, $book->getName());
            }
            $previousName = $book->getName();
        }
    }

    public function testFindByAuthor()
    {
        // Crea un nuevo libro y guárdalo en la base de datos
        $book = new Book();
        $book->setName('Dev Book Change');
        $book->setAuthor('Dev Author');
        $book->setDescription('Dev Author Description dev');
        $this->bookRepository->save($book);

        // Encuentra los libros por autor
        $foundBooks = $this->bookRepository->findByAuthor('Dev Author');

        // Asegura que se encontró al menos un libro
        $this->assertNotEmpty($foundBooks);

        // Asegura que todos los libros encontrados tienen el autor correcto
        foreach ($foundBooks as $foundBook) {
            $this->assertEquals('Dev Author', $foundBook->getAuthor());
        }
    }

    public function testFindById()
    {
        // Crea un nuevo libro y guárdalo en la base de datos
        $book = new Book();
        $book->setName('Dev Book Change');
        $book->setAuthor('Dev Author');
        $book->setDescription('Dev Author Description dev');
        $this->bookRepository->save($book);

        // Encuentra el libro por su ID
        $foundBook = $this->bookRepository->findById($book->getId());

        // Asegura que se encontró el libro
        $this->assertNotNull($foundBook);
        $this->assertEquals($book->getId(), $foundBook->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Limpia los datos después de cada prueba
        $this->entityManager->close();
        $this->entityManager = null; // Evita memory leaks
    }
}