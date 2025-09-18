<?php
/*
    Ce fichier contient les fonctions principales des menus de la vue du jeu du pendu.
*/
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'controllers'.DIRECTORY_SEPARATOR.'controllerDataInDatasFile.php';

/**
 * Affiche le menu principal du jeu et gère la sélection de l'utilisateur.
 *
 * Cette fonction présente les options pour démarrer le jeu ou quitter.
 * Elle valide la saisie de l'utilisateur et exécute l'action correspondante.
 *
 * @return string Retourne le résultat de la fonction displayWordCategoryChoiceMenu
 *                si l'utilisateur choisit de démarrer le jeu.
 */
function displayGameMenu(): string
{
    $isValid = false; // Variable pour contrôler la validité de la saisie

    // Boucle tant que la saisie n'est pas valide
    while (!$isValid) {
        // Affichage du menu principal
        echo "Bonjour ! Bienvenue dans le jeu du pendu." . PHP_EOL;
        echo "1. Jouer" . PHP_EOL;
        echo "2. Quitter" . PHP_EOL;
        echo "Veuillez choisir une option : ";

        $answer = trim(readline()); // Récupère et nettoie la saisie utilisateur

        // Gestion des choix possibles
        switch ($answer) {
            case "1":
                $isValid = true; // Met fin à la boucle
                // Appelle la fonction pour choisir une catégorie de mots
                return displayWordCategoryChoiceMenu();
            case "2":
                $isValid = true; // Met fin à la boucle
                echo "Au revoir !" . PHP_EOL;
                exit; // Quitte le programme
            default:
                // Message d'erreur si la saisie est invalide
                echo PHP_EOL."Veuillez choisir une option valide." . PHP_EOL;
                echo PHP_EOL;
        }
    }
}

/**
 * Affiche le menu de choix des catégories de mots et gère la sélection de l'utilisateur.
 *
 * Cette fonction liste les catégories disponibles et demande à l'utilisateur
 * d'en choisir une. Elle valide la saisie et retourne un mot aléatoire de la catégorie choisie.
 *
 * @return string Retourne un mot aléatoire de la catégorie sélectionnée.
 */
function displayWordCategoryChoiceMenu(): string
{
    // Affiche les catégories disponibles
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;

    // Récupère la liste des noms de catégories depuis le contrôleur
    $allCategoryWord = getTheNameOfTheWordCategory();

    // Affiche chaque catégorie avec un numéro
    for ($i = 0, $iMax = count($allCategoryWord); $i < $iMax; $i++) {
        echo ((string)($i + 1)) . " " . $allCategoryWord[$i] . PHP_EOL;
    }

    $isValid = false; // Variable pour contrôler la validité de la saisie

    // Boucle tant que la saisie n'est pas valide
    while (!$isValid) {
        echo "Veuillez choisir une catégorie (entrez le numéro) : ";
        $answer = trim(readline()); // Récupère et nettoie la saisie utilisateur

        // Vérifie que la saisie est un nombre valide et dans la plage des catégories disponibles
        if (ctype_digit($answer) && ((int)$answer) >= 1 && ((int)$answer) <= count($allCategoryWord)) {
            $isValid = true; // Met fin à la boucle si la saisie est valide
        } else {
            // Message d'erreur si la saisie est invalide
            echo "Erreur : catégorie invalide. Veuillez réessayer." . PHP_EOL;
        }
    }

    // Retourne un mot aléatoire de la catégorie choisie
    return getRandomWordFromTheCategory(((int)$answer));
}
?>
