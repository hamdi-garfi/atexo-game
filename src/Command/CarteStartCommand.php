<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CarteStartCommand extends Command
{
    protected static $defaultName = 'carte:start';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        function distribue($jeu, $nb, $main)
        {
            // initialisation
            $types = array(
                'jeu32' => 32,
                'jeu32J' => 34,
                '2jeu32' => 64,
                '2jeu32J' => 68,
                'jeu52' => 52,
                'jeu52J' => 54,
                '2jeu52' => 104,
                '2jeu52J' => 108,
                'tarot' => 78,
                'majjonh' => 144
            );
            $cartes = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 'valet', 'dame', 'roi', 'As');
            $couleurs = array('carreau', 'coeur', 'pic', 'trefle');
            // tests 
            if (!in_array($jeu, array_keys($types))) {
                return ("Le type de jeu peut etre :" . implode(', ', $types));
            }
            if ($main * $nb > $types[$jeu]) {
                return ("Pas assez de cartes pour distribuer le jeu : demande " . ($main * $nb) .
                    ". cartes disponibles : " . $types[$jeu]);
            }

            // creation du jeu 
            $jeux = range(0, $types[$jeu] - 1);
            $autre = array();
            if ($jeu == 'jeu32') {
                array_splice($cartes, 0, 5);
            }
            if ($jeu == 'jeu32J') {
                array_splice($cartes, 0, 5);
                $autre = array('Joker rouge', 'Joker noir');
            }
            if ($jeu == '2jeu32') {
                array_splice($cartes, 0, 5);
                $couleurs = array_merge($couleurs, $couleurs);
            }
            if ($jeu == '2jeu32J') {
                array_splice($cartes, 0, 5);
                $couleurs = array_merge($couleurs, $couleurs);
                $autre = array('Joker rouge', 'Joker noir', 'Joker rouge', 'Joker noir');
            }
            if ($jeu == 'jeu52') {
                //rien... 
            }
            if ($jeu == 'jeu52J') {
                $autre = array('Joker rouge', 'Joker noir');
            }
            if ($jeu == '2jeu52') {
                $couleurs = array_merge($couleurs, $couleurs);
            }
            if ($jeu == '2jeu52J') {
                $couleurs = array_merge($couleurs, $couleurs);
                $autre = array('Joker rouge', 'Joker noir', 'Joker rouge', 'Joker noir');
            }
            if ($jeu == 'tarot') {
                // les atouts 
                $autres = range(2, 21);
                for ($i = 0; $i < count($autres); $i++) {
                    $autres[$i] = $autres[$i] . " d'atout";
                }
                array_unshift($autres, 'Petit');
                array_push($autres, 'Excuse');
                $temp = array_splice($cartes, 10, 3);
                array_push($cartes, 'cavalier');
                $cartes = array_merge($cartes, $temp);
            }
            if ($jeu == 'majjonh') {
                $couleurs = array(
                    'bambou', 'fleurs', 'dix milles', 'bambou', 'fleurs',
                    'dix milles', 'bambou', 'fleurs', 'dix milles', 'bambou', 'fleurs', 'dix milles'
                );
                $cartes = range(1, 9);
                $autres = array(
                    'fortune', 'carte blanche', 'chine', 'est', 'nord', 'ouest',
                    'sud'
                );
                $autres = array_merge($autres, $autres, $autres, $autres);
            }
            for ($i = 0; $i < count($couleurs); $i++) {
                for ($j = 0; $j < count($cartes); $j++) {
                    $jeux[$i * count($cartes) + $j] = $cartes[$j] . ' de ' . $couleurs[$i];
                }
            }
            /*   for($i=0; $i<count($autres);$i++){
            $jeux[count($couleurs)*count($cartes)+$i] = $autres[$i]; 
            }  */

            //distribution 
            shuffle($jeux);
            $retour = array();
            for ($i = 0; $i < $nb; $i++) {
                $retour[$i] = array_splice($jeux, 0, $main);
                sort($retour[$i]);
            }
            //reste 
            $retour[$i++] = $jeux;
            // retour 
            return $retour;
        }


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
