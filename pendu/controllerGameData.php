<?php
/**
 * Fichier : controllerGame.php
 * Rôle : Contrôleur principal du jeu du Pendu
 */
declare(strict_types=1);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'gameData.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'fileData.php';



function displayGameInfo(string $hiddenWords, int $livesRemaining, string $letterUsed): void
{
    // Affichage structuré avec bordures pour une meilleure lisibilité
    echo PHP_EOL;
    echo "======================" . PHP_EOL;
    echo "  JEU DU PENDU" . PHP_EOL;
    echo "======================" . PHP_EOL;
    echo "Vies restantes : $livesRemaining".PHP_EOL;
    echo "Lettres proposées : $letterUsed".PHP_EOL;
    echo "mot: $hiddenWords".PHP_EOL;
    echo "======================" . PHP_EOL;
}

function getLetterFromUser(string $letterUsed): string
{
    while (true) {
        echo("Proposez une lettre : ");
        $letter = trim(readline());

        // Vérification combinée :
        // - Longueur = 1 caractère
        // - Caractère alphabétique (ctype_alpha)
        // - Lettre non déjà utilisée (str_contains)
        if (strlen($letter) === 1 && ctype_alpha($letter) && !str_contains($letterUsed, strtolower($letter))) {
            return strtolower($letter); // Retourne la lettre en minuscule pour uniformité
        }
        else {
            // Message d'erreur générique pour toutes les invalidités
            // Pour une meilleure UX, pourrait être décomposé en messages spécifiques
            echo "Erreur : veuillez entrer une seule lettre valide et non déjà utilisée." . PHP_EOL;
        }
    }
}

function displayWordCategoryChoiceMenu(): string
{
    // Affichage des catégories disponibles
    echo "======================" . PHP_EOL;
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;
    echo "======================" . PHP_EOL;

    // Récupération des noms de catégories depuis le contrôleur
    $allCategoryWord = getTheNameOfTheWordCategoryInAllData();

    // Affichage numéroté des catégories (1 à N)
    foreach ($allCategoryWord as $i => $iValue) {
        echo ((string)($i + 1)) . " " . $iValue . PHP_EOL;
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
    return retrieveARandomWordFromATableComposedOfTables(((int)$answer));
}

function playGame():void
{
    // Initialisation
    $wordsFound = displayWordCategoryChoiceMenu();
    $hiddenWord = createHiddenWordAccordingToGivenWord($wordsFound);
    $livesRemaining = 6;
    $letterUsed = "";

    // Boucle principale - continue tant que :
    // 1. Il reste des vies ($livesRemaining > 0)
    // 2. Le mot n'est pas complètement deviné ($hiddenWord !== $wordsFound)
    while ($livesRemaining > 0 && $hiddenWord !== $wordsFound) {
        displayGameInfo($hiddenWord, $livesRemaining, $letterUsed);

        // Récupération d'une lettre valide
        $chosenLetter = getLetterFromUser($letterUsed);

        // Vérification de la lettre dans le mot
        $result = checkTheLetterIsInTheWordsAndReturnBool($chosenLetter, $wordsFound);

        if ($result) {
            // Cas positif : lettre trouvée
            $hiddenWordModified = revealLetterInHiddenWord($chosenLetter, $wordsFound, $hiddenWord);
            $hiddenWord = $hiddenWordModified;
            $letterUsed .= $chosenLetter;
            // Note : Aucun message de confirmation n'est affiché pour une bonne réponse
        }
        else {
            // Cas négatif : lettre non trouvée
            $livesRemaining--;
            $letterUsed .= $chosenLetter;
            echo "La lettre $chosenLetter n'est pas dans le mot. Vous avez perdu une vie." . PHP_EOL;
        }
    }

    // Détermination du résultat final
    // Comparaison directe qui peut poser problème (voir @warning)
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
