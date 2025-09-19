<?php
/**
 * Fichier : gameData.php
 * Rôle : Traitement des données et logique métier pour le jeu du Pendu
 *
 * Ce fichier contient les fonctions pour :
 * - Créer une version masquée d'un mot
 * - Vérifier la présence d'une lettre dans un mot
 * - Révéler les lettres devinées dans le mot masqué
 */

/**
 * Crée une version complètement masquée d'un mot
 *
 * @param string $givenWord Le mot à masquer
 * @return string Une chaîne de caractères composée d'étoiles (*) de même longueur que le mot
 *
 * Exemple : "bonjour" → "*******"
 */
function createHiddenWordAccordingToGivenWord(string $givenWord): string
{
    $hiddenWord = "";

    // Parcourt chaque caractère du mot et le remplace par une étoile
    for ($i = 0, $iMax = strlen($givenWord); $i < $iMax; $i++) {
        $hiddenWord .= "*";
    }

    return $hiddenWord;
}

/**
 * Vérifie si une lettre est présente dans un mot (insensible à la casse)
 *
 * @param string $chosenLetter La lettre à vérifier
 * @param string $wordsFound Le mot dans lequel chercher
 * @return bool True si la lettre est présente, false sinon
 *
 * La comparaison est insensible à la casse (majuscule/minuscule)
 */
function checkTheLetterIsInTheWordsAndReturnBool(string $chosenLetter, string $wordsFound): bool
{
    // Convertit le mot et la lettre en minuscules pour une comparaison insensible à la casse
    return str_contains(strtolower($wordsFound), strtolower($chosenLetter));
}

/**
 * Révèle les occurrences d'une lettre dans le mot masqué
 *
 * @param string $letter La lettre devinée
 * @param string $secretWord Le mot secret original
 * @param string $hiddenWord Le mot actuellement masqué
 * @return string Le mot masqué mis à jour avec les lettres révélées
 *
 * Processus :
 * 1. Convertit le mot masqué et le mot secret en tableaux de caractères
 * 2. Compare chaque caractère du mot secret avec la lettre devinée
 * 3. Remplace les étoiles par la lettre aux positions correspondantes
 * 4. Conserve la casse originale du mot secret
 *
 * Note : La fonction ne vérifie pas si la lettre est effectivement dans le mot
 * (cette vérification doit être faite avant avec checkTheLetterIsInTheWordsAndReturnBool)
 */
function revealLetterInHiddenWord(string $letter, string $secretWord, string $hiddenWord): string
{
    // Conversion en tableaux pour une manipulation plus facile
    $hiddenArray = str_split($hiddenWord);
    $secretArray = str_split(strtolower($secretWord));
    $letter = strtolower($letter);

    // Parcourt chaque caractère du mot secret
    for ($i = 0, $iMax = strlen($secretWord); $i < $iMax; $i++) {
        // Si la lettre correspond et que la position est encore masquée ('*')
        if ($secretArray[$i] === $letter && $hiddenArray[$i] === '*') {
            // Révèle la lettre en conservant sa casse originale
            $hiddenArray[$i] = $secretWord[$i];
        }
    }

    // Reconvertit le tableau en chaîne de caractères
    return implode('', $hiddenArray);
}
?>
