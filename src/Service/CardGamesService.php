<?php

namespace App\Service;

class CardGamesService
{

   /**
    * Cette methode permet de construire un ordre aléatoire des couleurs.
    * 
    * @return string
    */
    public function createRandomColorOrder(): string
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}
