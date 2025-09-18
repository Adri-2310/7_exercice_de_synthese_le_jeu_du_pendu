<?php
/*
    Ce fichier contient les fonctions principales de la gestion des données du jeu du pendu.
*/
/**
 * Lit un fichier JSON à partir du chemin fourni et retourne les données sous forme de tableau associatif.
 *
 * @param string $path Chemin du fichier JSON à lire.
 * @return array|null Tableau associatif des données JSON ou null si le fichier n'existe pas.
 */
function getDataInJsonAndReturnByArrayData(string $path): ?array
{
    if (!file_exists($path)) {
        return null;
    }
    $content = file_get_contents($path);
    return json_decode($content, true);
}

/**
 * Récupère un mot aléatoire dans un tableau de tableaux.
 *
 * @param array $data Tableau de tableaux contenant les mots.
 * @return string Un mot aléatoire.
 */
function retrieveARandomWordFromATableComposedOfTables(array $data): string
{
    $keys = array_keys($data);
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;
    for ($i = 0, $iMax = count($keys); $i < $iMax; $i++) {
        echo ((string)($i + 1)) . " " . $keys[$i] . PHP_EOL;
    }
    $isValid = false;
    while (!$isValid) {
        echo "Veuillez choisir une catégorie (entrez le numéro) : ";
        $answer = trim(readline());

        if (ctype_digit($answer) && ((int)$answer) >= 1 && ((int)$answer) <= count($keys)) {
            $isValid = true; // Sort de la boucle si l'entrée est valide
        } else {
            echo "Erreur : catégorie invalide. Veuillez réessayer." . PHP_EOL;
        }
    }

    $chosenIndex = ((int)$answer) - 1;
    $chosenKey = $keys[$chosenIndex];
    $tableOfTheChosenCategory = $data[$chosenKey];
    $randomIndex = array_rand($tableOfTheChosenCategory);
    return $tableOfTheChosenCategory[$randomIndex] ;
}
?>