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
function getDataInJsonAndReturnByArrayData(): ?array
{
    $path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dictionnaire.json';
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
function retrieveARandomWordFromATableComposedOfTables(int $categoryIndex): string
{
    $data = getDataInJsonAndReturnByArrayData();
    $keys = array_keys($data);
    $chosenKey = $keys[$categoryIndex - 1];
    $words = $data[$chosenKey];
    $randomIndex = array_rand($words);
    return $words[$randomIndex];

}

function getTheNameOfTheWordCategoryInAllData(): array{
    $alldata = getDataInJsonAndReturnByArrayData();
    return array_keys($alldata);
}
?>