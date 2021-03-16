<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\CardGamesService;
use Symfony\Component\Console\Helper\Table;

class CarteStartCommand extends Command
{
    protected static $defaultName = 'carte:generate';
    protected static $defaultDescription = 'Cette commande permet de construire des cartes alétoires';

    /**
     * @var CardGamesService
     */
    private CardGamesService $CardGamesService;

    public function __construct(CardGamesService $CardGamesService)
    {
        $this->CardGamesService = $CardGamesService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('nbrCards', null, InputOption::VALUE_OPTIONAL, 'Nombre de cartes ? dfault= 10')
            ->addOption('order', null, InputOption::VALUE_OPTIONAL, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $nbrCards = $input->getArgument('nbrCards');

        if ($nbrCards) {
            $io->note(sprintf('Le nombre de cartes est: %s', $nbrCards));
        }

        $cards = $this->CardGamesService->generateTenCards();

        // Les cartes affichés sous forme de table
        $table = new Table($output);
        $table
            ->setHeaders(['Numéro', 'Coleur', 'Valeur'])
            ->setRows($cards);
            
        $table->render();

        // outputs a message without adding a "\n" at the end of the line

        $io->success(' Success ! les cartes sont generées avec succès !!');

        return Command::SUCCESS;
    }
}
