<?php

namespace App\Application\Command;

use App\Domain\Repository\BookRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:list-books',
    description: 'List of books.',
    hidden: false,
    aliases: ['app:list-books']
)]
class ListBooksCommand extends Command
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Lists all books.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $books = $this->bookRepository->findAll();

        $io->title('List of Books');
        foreach ($books as $book) {
            $io->writeln(sprintf('<info>%s</info> by %s', $book->getName(), $book->getAuthor()));
        }

        return Command::SUCCESS;
    }
}