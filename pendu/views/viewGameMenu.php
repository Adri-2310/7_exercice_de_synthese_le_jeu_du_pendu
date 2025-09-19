<?php
/*
    Fichier : viewGameMenu.php
    Rôle : Gère l'interface utilisateur pour la navigation dans les menus du jeu du pendu.
    Contient les fonctions d'affichage et de traitement des choix utilisateur pour :
    - Le menu principal (Jouer/Quitter)
    - La sélection de catégorie de mots
*/

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'controllers'.DIRECTORY_SEPARATOR.'controllerDataInDatasFile.php';

/**
 * Affiche le menu principal et traite la sélection utilisateur.
 *
 * Processus :
 * 1. Affiche les options disponibles (Jouer ou Quitter)
 * 2. Valide la saisie utilisateur (doit être "1" ou "2")
 * 3. Redirige vers le menu de catégorie ou termine le programme
 *
 * @return string Le mot à deviner (via displayWordCategoryChoiceMenu) si l'utilisateur choisit de jouer
 * @exit Termine le programme si l'utilisateur choisit de quitter
 */
function displayGameMenu(): string
{
    $isValid = false; // Indicateur de validité de la saisie utilisateur

    // Boucle jusqu'à obtenir une saisie valide
    while (!$isValid) {
        // Affichage des options disponibles
        echo "Bonjour ! Bienvenue dans le jeu du pendu." . PHP_EOL;
        echo "1. Jouer" . PHP_EOL;
        echo "2. Quitter" . PHP_EOL;
        echo "Veuillez choisir une option : ";

        $answer = trim(readline());

        // Traitement du choix utilisateur
        switch ($answer) {
            case "1":
                $isValid = true;
                // L'utilisateur souhaite jouer : affichage du menu des catégories
                return displayWordCategoryChoiceMenu();

            case "2":
                $isValid = true;
                echo "Au revoir !" . PHP_EOL;
                exit; // Sortie du programme

            default:
                // Gestion des saisies invalides
                echo PHP_EOL."Veuillez choisir une option valide." . PHP_EOL;
                echo PHP_EOL;
        }
    }
}

/**
 * Affiche les catégories de mots disponibles et traite la sélection utilisateur.
 *
 * Fonctionnement :
 * 1. Récupère la liste des catégories via getTheNameOfTheWordCategory()
 * 2. Affiche chaque catégorie avec un numéro d'index (1-N)
 * 3. Valide que la saisie correspond à un numéro de catégorie existant
 * 4. Retourne un mot aléatoire de la catégorie sélectionnée via getRandomWordFromTheCategory()
 *
 * @return string Un mot aléatoire de la catégorie choisie
 *
 * @see getTheNameOfTheWordCategory() Pour la récupération des catégories
 * @see getRandomWordFromTheCategory() Pour la sélection du mot
 */
function displayWordCategoryChoiceMenu(): string
{
    // Affichage des catégories disponibles
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;

    // Récupération des noms de catégories depuis le contrôleur
    $allCategoryWord = getTheNameOfTheWordCategory();

    // Affichage numéroté des catégories (1 à N)
    for ($i = 0, $iMax = count($allCategoryWord); $i < $iMax; $i++) {
        echo ((string)($i + 1)) . " " . $allCategoryWord[$i] . PHP_EOL;
    }

    $isValid = false; // Réinitialisation de l'indicateur de validité

    // Boucle de validation de la saisie utilisateur
    while (!$isValid) {
        echo "Veuillez choisir une catégorie (entrez le numéro) : ";
        $answer = trim(readline());

        // Vérification : doit être un nombre entier dans la plage [1, nombre de catégories]
        if (ctype_digit($answer) && ((int)$answer) >= 1 && ((int)$answer) <= count($allCategoryWord)) {
            $isValid = true; // Saisie valide : sortie de boucle
        } else {
            // Message d'erreur pour saisie invalide
            echo "Erreur : catégorie invalide. Veuillez réessayer." . PHP_EOL;
        }
    }

    // Retourne un mot aléatoire de la catégorie sélectionnée
    return getRandomWordFromTheCategory(((int)$answer));
}
?>
