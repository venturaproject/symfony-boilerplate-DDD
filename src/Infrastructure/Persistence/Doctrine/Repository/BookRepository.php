<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Book;
use App\Domain\Repository\BookRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('b')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedByName(): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByAuthor(string $author): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.author = :author')
            ->setParameter('author', $author)
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findById(int $id): ?Book
    {
        return $this->find($id);
    }

    public function save(Book $book): void
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
    }

    public function delete(Book $book): void
    {
        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }
}