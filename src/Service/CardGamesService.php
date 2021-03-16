<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class CardGamesService
{

    private array $randomcolor = [];
    private array $valueCards = [];

    public function __construct(string $randomcolor, string $valueCards)
    {
        $this->randomcolor =  explode(",", $randomcolor);
        $this->valueCards = explode(",", $valueCards);
    }

    /**
     * Cette methode permet de construire un ordre aléatoire des couleurs.
     * 
     * @return string
     */
    public function generateRandomColorOrder(): ?string
    {
        $index = array_rand($this?->randomcolor);  // Null SAFE
        return $this->randomcolor[$index];
    }

    /**
     * Cette methode permet de construire des valeurs de jeu de cartes.
     * 
     * @return string
     */
    public function generateValueCards(): ?string
    {
        $index = array_rand($this?->valueCards);  // Null SAFE
        return $this->valueCards[$index];
    }


    /**
     * Cette methode permet de générer des cartes d'une facon aléatoire
     * 
     * @return array
     */
    public function generateTenCards(int $nbrCards = 10): ?array
    {
        $cards = [];
        for ($i = 0; $i < $nbrCards; $i++) {
            $cards[] = [$this->generateRandomColorOrder() => $this->generateValueCards()];
        }

        return $cards;
    }
}
