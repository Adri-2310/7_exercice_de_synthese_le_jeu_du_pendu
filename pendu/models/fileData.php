<?php
/*
    Fichier : controllerDataInDatasFile.php
    Rôle : Gestion centralisée des données du jeu du pendu.
    Fonctionnalités :
    - Lecture et décodage du fichier JSON de dictionnaire
    - Récupération aléatoire de mots par catégorie
    - Extraction des noms de catégories disponibles
*/

/**
 * Charge et décode le fichier JSON contenant le dictionnaire de mots.
 *
 * Localisation du fichier :
 * ./data/dictionnaire.json (relatif à ce fichier)
 *
 * @return array|null Tableau associatif des données si le fichier existe et est valide,
 *                    null en cas d'erreur (fichier introuvable ou illisible)
 *
 * @example Retourne :
 *          [
 *              "animaux" => ["chien", "chat", "lapin"],
 *              "pays" => ["France", "Belgique", "Allemagne"]
 *          ]
 *          ou null si le fichier est inaccessible
 */
function getDataInJsonAndReturnByArrayData(): ?array
{
    $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'data' . DIRECTORY_SEPARATOR . 'dictionnaire.json';
    if (!file_exists($path)) {
        return null;
    }
    $content = file_get_contents($path);
    return json_decode($content, true);
}

/**
 * Sélectionne un mot aléatoire dans une catégorie spécifique.
 *
 * @param int $categoryIndex Index de la catégorie (1 pour la première catégorie, 2 pour la deuxième, etc.)
 * @return string Un mot aléatoire de la catégorie demandée
 *
 * @throws RuntimeException Si le fichier JSON est invalide ou si la catégorie n'existe pas
 *
 * @example Pour $categoryIndex = 1 et un JSON comme :
 *          {"animaux":["chien","chat"],"pays":["France"]}
 *          Peut retourner "chien" ou "chat"
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

/**
 * Récupère la liste de toutes les catégories disponibles dans le dictionnaire.
 *
 * @return array Tableau des noms de catégories (clés du JSON)
 *
 * @example Pour un JSON comme :
 *          {"fruits":["pomme"],"légumes":["carotte"]}
 *          Retourne : ["fruits", "légumes"]
 */
function getTheNameOfTheWordCategoryInAllData(): array
{
    $alldata = getDataInJsonAndReturnByArrayData();
    return array_keys($alldata);
}
?>
