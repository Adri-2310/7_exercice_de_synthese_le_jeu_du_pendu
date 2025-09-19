<?php
/**
 * Fichier : controllerGame.php
 * Rôle : Contrôleur principal du jeu du Pendu
 * Gère l'affichage et la logique principale du jeu
 */

// Activation du typage strict pour tout le fichier
declare(strict_types=1);

// Import des modèles nécessaires:
// - gameData.php: contient les fonctions de gestion des données de jeu
// - fileData.php: contient les fonctions de gestion des fichiers de données
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'gameData.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'fileData.php';


/**
 * Affiche les informations actuelles de la partie
 *
 * @param string $hiddenWords Mot partiellement deviné (ex: "m _ _ e")
 * @param int $livesRemaining Nombre de vies restantes
 * @param string $letterUsed Lettres déjà proposées par le joueur
 */
function displayGameInfo(string $hiddenWords, int $livesRemaining, string $letterUsed): void
{
    // Affiche une interface claire avec toutes les informations de jeu
    // Les bordures améliorent la lisibilité et la séparation visuelle
    echo PHP_EOL;
    echo "======================" . PHP_EOL;
    echo "  JEU DU PENDU" . PHP_EOL;
    echo "======================" . PHP_EOL;
    echo "Vies restantes : $livesRemaining".PHP_EOL;
    echo "Lettres proposées : $letterUsed".PHP_EOL;
    echo "mot: $hiddenWords".PHP_EOL;
    echo "======================" . PHP_EOL;
}

/**
 * Récupère une lettre valide de l'utilisateur
 *
 * @param string $letterUsed Lettres déjà utilisées dans la partie
 * @return string Une lettre valide en minuscule
 *
 * La fonction vérifie que:
 * 1. La saisie contient exactement 1 caractère
 * 2. Le caractère est une lettre (a-z, A-Z)
 * 3. La lettre n'a pas déjà été utilisée
 * Boucle jusqu'à obtenir une saisie valide
 */
function getLetterFromUser(string $letterUsed): string
{
    while (true) {
        echo("Proposez une lettre : ");
        $letter = trim(readline());

        // Validation de la saisie:
        // - longueur = 1
        // - caractère alphabétique
        // - lettre non déjà utilisée
        if (strlen($letter) === 1 && ctype_alpha($letter) && !str_contains($letterUsed, strtolower($letter))) {
            return strtolower($letter); // Retourne la lettre en minuscule pour uniformité
        }
        else {
            // Message d'erreur pour saisie invalide
            echo "Erreur : veuillez entrer une seule lettre valide et non déjà utilisée." . PHP_EOL;
        }
    }
}
/**
 * Affiche le menu de sélection de catégorie et retourne un mot aléatoire
 *
 * @return string Un mot aléatoire de la catégorie choisie
 *
 * Processus:
 * 1. Affiche la liste des catégories disponibles
 * 2. Demande à l'utilisateur de choisir une catégorie
 * 3. Valide la saisie (doit être un numéro de catégorie valide)
 * 4. Retourne un mot aléatoire de la catégorie sélectionnée
 *
 */
function displayWordCategoryChoiceMenu(): string
{
    // Affiche l'en-tête du menu de catégories
    echo "======================" . PHP_EOL;
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;
    echo "======================" . PHP_EOL;

    // Récupère et affiche les catégories disponibles
    $allCategoryWord = getTheNameOfTheWordCategoryInAllData();
    foreach ($allCategoryWord as $i => $iValue) {
        echo ((string)($i + 1)) . " " . $iValue . PHP_EOL;
    }

    // Validation de la saisie utilisateur
    $isValid = false;
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
    return retrieveARandomWordFromATableComposedOfTables(((int)$answer-1));
}

/**
 * Gère une partie complète du jeu du pendu
 *
 * Processus:
 * 1. Initialise une nouvelle partie (mot, vies, lettres utilisées)
 * 2. Boucle principale de jeu:
 *    - Affiche l'état actuel
 *    - Demande une lettre
 *    - Vérifie si la lettre est dans le mot
 *    - Met à jour l'état du jeu
 * 3. Affiche le résultat final (victoire ou défaite)
 */
function playGame():void
{
    // Initialisation de la partie
    $wordsFound = displayWordCategoryChoiceMenu();
    $hiddenWord = createHiddenWordAccordingToGivenWord($wordsFound);
    $livesRemaining = 6;
    $letterUsed = "";

    // Boucle principale du jeu
    while ($livesRemaining > 0 && $hiddenWord !== $wordsFound) {
        displayGameInfo($hiddenWord, $livesRemaining, $letterUsed);

        // Récupération d'une lettre valide
        $chosenLetter = getLetterFromUser($letterUsed);

        // Vérification de la lettre dans le mot
        $result = checkTheLetterIsInTheWordsAndReturnBool($chosenLetter, $wordsFound);

        if ($result) {
            // Lettre trouvée: met à jour le mot masqué
            $hiddenWordModified = revealLetterInHiddenWord($chosenLetter, $wordsFound, $hiddenWord);
            $hiddenWord = $hiddenWordModified;
            $letterUsed .= $chosenLetter;
        }
        else {
            // Lettre non trouvée: perd une vie
            $livesRemaining--;
            $letterUsed .= $chosenLetter;
            echo "La lettre $chosenLetter n'est pas dans le mot. Vous avez perdu une vie." . PHP_EOL;
        }
    }

    // Affichage du résultat final
    echo "======================" . PHP_EOL;
    if ($hiddenWord === $wordsFound) {
        // Message de victoire avec le mot deviné
        echo("!!! Vous avez gagné !!!" . PHP_EOL);
        echo("Bravo le mot était : $wordsFound" . PHP_EOL);
    }
    else {
        // Message de défaite avec le mot à deviner
        echo("Vous avez perdu !" . PHP_EOL);
        echo("Dommage le mot était : $wordsFound" . PHP_EOL);
    }
    echo "======================" . PHP_EOL;

}
?>
