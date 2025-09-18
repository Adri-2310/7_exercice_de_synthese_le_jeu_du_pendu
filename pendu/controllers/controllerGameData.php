<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'gameData.php';
/*
    Ce fichier contient les fonctions du controllers de données de partie du jeu du pendu.
*/
function createHiddenWord(string $givenWord): string{
    return createHiddenWordAccordingToGivenWord($givenWord);
}