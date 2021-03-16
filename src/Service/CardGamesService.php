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
    public function generateRandomColorOrder(): string
    {
        $index = array_rand($this->randomcolor);
        return $this->randomcolor[$index];
    }

     /**
     * Cette methode permet de construire un ordre aléatoire des couleurs.
     * 
     * @return string
     */
    public function generateValueCards(): string
    {
        $index = array_rand($this->valueCards);
        return $this->valueCards[$index];
    }
}
