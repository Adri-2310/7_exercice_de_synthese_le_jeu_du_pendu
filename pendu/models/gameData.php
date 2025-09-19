<?php
/*
    Fichier : gameData.php
    Rôle : Module de traitement des données pour le jeu du Pendu.

    Ce fichier contient les fonctions de base pour :
    - La création et manipulation des mots masqués
    - La vérification des lettres proposées
    - La révélation progressive des lettres devinées

    Dépendances : Aucune
*/

/**
 * Génère une version masquée d'un mot donné.
 *
 * Chaque caractère du mot est remplacé par un astérisque (*)
 * pour créer une représentation masquée de même longueur.
 *
 * @param string $givenWord Le mot original à masquer
 * @return string Une chaîne composée uniquement d'astérisques (*)
 *                de même longueur que le mot original
 *
 * @example createHiddenWordAccordingToGivenWord("test") => "****"
 * @example createHiddenWordAccordingToGivenWord("Bonjour") => "*******"
 */
function createHiddenWordAccordingToGivenWord(string $givenWord): string
{
    $hiddenWord = "";
    for ($i = 0, $iMax = strlen($givenWord); $i < $iMax; $i++) {
        $hiddenWord .= "*";
    }
    return $hiddenWord;
}

/**
 * Vérifie la présence d'une lettre dans un mot.
 *
 * Effectue une recherche insensible à la casse pour déterminer
 * si la lettre proposée existe dans le mot à deviner.
 *
 * @param string $chosenLetter La lettre proposée par le joueur (1 caractère)
 * @param string $wordsFound Le mot complet à deviner
 * @return bool True si la lettre est trouvée, false sinon
 *
 * @note La comparaison est insensible à la casse
 */
function checkTheLetterIsInTheWordsAndReturnBool(string $chosenLetter, string $wordsFound): bool
{
    // Vérifie si la lettre est présente dans le mot (insensible à la casse)
    return str_contains(strtolower($wordsFound), strtolower($chosenLetter));
}

/**
 * Révèle les occurrences d'une lettre dans un mot masqué.
 *
 * Pour chaque occurrence de la lettre dans le mot secret,
 * remplace le caractère masqué par la lettre correspondante.
 *
 * @param string $letter La lettre devinée par le joueur
 * @param string $secretWord Le mot secret complet à deviner
 * @param string $hiddenWord Le mot actuellement masqué (format: "_ _ _ _")
 *
 * @return string Le mot masqué mis à jour avec les lettres révélées
 *
 * @note Problème d'incohérence détecté :
 *       - createHiddenWordAccordingToGivenWord() génère des "*"
 *       - Cette fonction attend des "_" comme caractères de masquage
 *       Cela peut causer des dysfonctionnements dans le jeu
 *
 * @example revealLetterInHiddenWord('e', 'test', '_ _ _ _') => 't e _ _'
 */
function revealLetterInHiddenWord(string $letter, string $secretWord, string $hiddenWord): string
{
    // Convertir en tableaux pour faciliter la manipulation
    $hiddenArray = str_split($hiddenWord);
    $secretArray = str_split(strtolower($secretWord));
    $letter = strtolower($letter);

    // Parcourir chaque caractère du mot secret
    for ($i = 0, $iMax = strlen($secretWord); $i < $iMax; $i++) {
        // Si la lettre correspond et que la position est encore masquée ('_')
        if ($secretArray[$i] === $letter && $hiddenArray[$i] === '*') {
            $hiddenArray[$i] = $secretWord[$i]; // Révéler la lettre (casse originale conservée)
        }
    }

    // Reconvertir en chaîne avec des espaces entre chaque caractère
    return implode('', $hiddenArray);
}
?>
