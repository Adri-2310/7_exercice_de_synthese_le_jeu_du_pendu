<?php
/*
    Ce fichier contient les fonctions principales de la gestion de la vue du jeu du pendu.
*/
require_once __DIR__.DIRECTORY_SEPARATOR.'controller.php';

/**
 * Affiche le menu principal du jeu et gère le choix de l'utilisateur.
 */
function displayGameMenu(): void
{
    $isValid = false;

    while (!$isValid) {
        echo "Bonjour ! Bienvenue dans le jeu du pendu." . PHP_EOL;
        echo "1. Jouer" . PHP_EOL;
        echo "2. Quitter" . PHP_EOL;
        echo "Veuillez choisir une option : ";

        $answer = trim(readline());

        switch ($answer) {
            case "1":
                $isValid = true;
                // Logique pour lancer le jeu
                displayWordCategoryChoiceMenu();
                break;
            case "2":
                $isValid = true;
                echo "Au revoir !" . PHP_EOL;
                exit; // Quitte le programme
            default:
                echo PHP_EOL."Veuillez choisir une option valide." . PHP_EOL;
                echo PHP_EOL;
        }
    }
}

function displayWordCategoryChoiceMenu(): void{
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;
    $allCategoryWord = getTheNameOfTheWordCategory();
    for ($i = 0, $iMax = count($allCategoryWord); $i < $iMax; $i++) {
        echo ((string)($i + 1)) . " " . $allCategoryWord[$i] . PHP_EOL;
    }
    $isValid = false;
    while (!$isValid) {
        echo "Veuillez choisir une catégorie (entrez le numéro) : ";
        $answer = trim(readline());

        if (ctype_digit($answer) && ((int)$answer) >= 1 && ((int)$answer) <= count($allCategoryWord)) {
            $isValid = true; // Sort de la boucle si l'entrée est valide
        } else {
            echo "Erreur : catégorie invalide. Veuillez réessayer." . PHP_EOL;
        }
    }
    $word = getRandomWordFromTheCategory(((int)$answer));
    echo "Le mot choisi est : " . $word . PHP_EOL;
    // Logique pour lancer le jeu avec $word in initial
}

?>