<?php
/**
 * Fichier : app.php
 * Gère l'interface utilisateur et le flux principal du jeu du Pendu
 */

// Active le mode strict pour le typage des variables
declare(strict_types=1);

// Charge le fichier contenant la logique du jeu
require_once __DIR__ . DIRECTORY_SEPARATOR . 'controllerGameData.php';

/**
 * Affiche le menu principal et retourne le choix de l'utilisateur
 *
 * @return string La réponse de l'utilisateur (1 ou 2)
 */
function displayMainMenu(): string
{
    // Affiche le menu et demande à l'utilisateur de faire un choix
    echo "======================" . PHP_EOL;
    echo "Bonjour ! Bienvenue dans le jeu du pendu." . PHP_EOL;
    echo "======================" . PHP_EOL;
    echo "1. Jouer" . PHP_EOL;
    echo "2. Quitter" . PHP_EOL;
    echo "Veuillez choisir une option : ";

    // Retourne la saisie utilisateur sans espaces superflus
    return trim(readline());
}

/**
 * Demande à l'utilisateur s'il souhaite rejouer
 *
 * @return bool True si l'utilisateur veut rejouer, sinon termine le programme
 */
function askToPlayAgain(): bool
{
    // Affiche les options de fin de partie
    echo PHP_EOL . "======================" . PHP_EOL;
    echo "1. Rejouer" . PHP_EOL;
    echo "2. Quitter" . PHP_EOL;

    // Boucle jusqu'à obtenir une réponse valide
    while (true) {
        echo "Que souhaitez-vous faire ? ";
        $answer = trim(readline());

        if ($answer === "1") {
            return true;  // Recommencer une partie
        }
        elseif ($answer === "2") {
            echo "Au revoir !" . PHP_EOL;
            exit;  // Quitter le programme
        }
        else {
            // Message d'erreur pour choix invalide
            echo PHP_EOL . "Veuillez choisir une option valide." . PHP_EOL;
        }
    }
}

/**
 * Point d'entrée principal du jeu
 * Gère la boucle principale des parties
 */
function start(): void
{
    // Boucle infinie pour le menu principal
    while (true) {
        $choice = displayMainMenu();

        if ($choice === "1") {
            // Boucle de jeu : lance des parties tant que l'utilisateur veut rejouer
            do {
                playGame();  // Fonction définie dans controllerGameData.php
            } while (askToPlayAgain());
        }
        elseif ($choice === "2") {
            echo "Au revoir !" . PHP_EOL;
            exit;  // Quitter le programme
        }
        else {
            // Message d'erreur pour choix invalide
            echo PHP_EOL . "Veuillez choisir une option valide." . PHP_EOL;
        }
    }
}
