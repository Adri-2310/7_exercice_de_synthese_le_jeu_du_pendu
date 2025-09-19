<?php
/*
    Ce fichier contient la fonction principale de l'affichage du jeu du pendu.
*/
function displayGame(string $hiddenWords,int $livesRemaining,string $letterUsed): void{
    echo PHP_EOL;
    echo "Vies restantes : $livesRemaining".PHP_EOL;
    echo "Lettres proposées : $letterUsed".PHP_EOL;
    echo "mot: $hiddenWords".PHP_EOL;
}

/**
 * Demande à l'utilisateur de proposer une lettre et retourne cette lettre.
 *
 * Cette fonction vérifie que la saisie est une seule lettre alphabétique.
 * Si ce n'est pas le cas, elle redemande une saisie valide.
 *
 * @return string Une lettre alphabétique en minuscule.
 */
function getLetterFromUser(): string
{
    while (true) {
        echo("Proposez une lettre : ");
        $letter = trim(readline());

        // Vérifie que la saisie est une seule lettre alphabétique
        if (strlen($letter) === 1 && ctype_alpha($letter)) {
            return strtolower($letter); // Retourne la lettre en minuscule
        } else {
            echo "Erreur : veuillez entrer une seule lettre valide." . PHP_EOL;
        }
    }
}
