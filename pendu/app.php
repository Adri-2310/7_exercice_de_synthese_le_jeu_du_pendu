<?php
/*
    Ce fichier contient la fonction principale du jeu du pendu.
*/
require_once __DIR__.DIRECTORY_SEPARATOR.'data.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'views'.DIRECTORY_SEPARATOR.'viewGameMenu.php';


/**
 * Starts the game by loading the dictionary and selecting a random word.
 *
 * @return void
 */
function start(): void
{
    displayGameMenu();
    /*
    $result = getDataInJsonAndReturnByArrayData(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data/dictionnaire.json");
    if ($result === null) {
        echo "Erreur : impossible de charger le dictionnaire." . PHP_EOL;
        return;
    }

    $wordSelected = retrieveARandomWordFromATableComposedOfTables($result);
    */
}
?>
