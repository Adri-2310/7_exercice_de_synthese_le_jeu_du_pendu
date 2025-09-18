<?php
/*
    Ce fichier contient les fonctions principales du traitement des données de partie encours du jeu du pendu.
*/
function createHiddenWordAccordingToGivenWord(string $givenWord): string{
    $hiddenWord = "";
    for ($i = 0, $iMax = strlen($givenWord); $i < $iMax; $i++) {
        $hiddenWord .= "*";
    }
    return $hiddenWord;
}