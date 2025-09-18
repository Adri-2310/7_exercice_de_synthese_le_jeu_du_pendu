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