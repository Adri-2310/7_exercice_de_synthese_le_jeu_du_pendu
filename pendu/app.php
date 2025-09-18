<?php
/*
    Ce fichier contient la fonction principale du jeu du pendu.
*/
require_once __DIR__ . DIRECTORY_SEPARATOR .'controllers'.DIRECTORY_SEPARATOR.'controllerGameData.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'views'.DIRECTORY_SEPARATOR.'viewGameMenu.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'views'.DIRECTORY_SEPARATOR.'viewGame.php';


/**
 * Starts the game by loading the dictionary and selecting a random word.
 *
 * @return void
 */
function start(): void
{
    $wordsFound =displayGameMenu();
    $hiddenWords = createHiddenWord($wordsFound);
    $livesRemaining = 6;
    $letterUsed = "";
    displayGame($hiddenWords,$livesRemaining,$letterUsed);
    // $proposedLetters = fonction dans la vue qui va demander une lettresByUser;
    //$hiddenWords = fonction du controllers pour dévoiler les lettres proposé;
}
?>
