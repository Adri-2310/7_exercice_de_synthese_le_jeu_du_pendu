<?php
/**
 * Fichier : controllerDataInDatasFile.php
 * Rôle : Gestion des données du dictionnaire pour le jeu du Pendu
 *
 * Ce fichier contient les fonctions pour :
 * - Lire et décoder le fichier JSON contenant le dictionnaire
 * - Récupérer des mots aléatoires par catégorie
 * - Obtenir la liste des catégories disponibles
 */

/**
 * Lit le fichier JSON du dictionnaire et retourne son contenu sous forme de tableau associatif
 *
 * @return array|null Retourne un tableau associatif des données ou null si le fichier n'existe pas
 *
 * Processus :
 * 1. Construit le chemin vers le fichier dictionnaire.json
 * 2. Vérifie l'existence du fichier
 * 3. Lit le contenu du fichier
 * 4. Décode le JSON en tableau associatif PHP
 *
 * Chemin relatif : ../../data/dictionnaire.json (remonte de 2 niveaux puis descend dans data)
 */
function getDataInJsonAndReturnByArrayData(): ?array
{
    // Construction du chemin vers le fichier JSON
    $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'data' . DIRECTORY_SEPARATOR . 'dictionnaire.json';

    // Vérification de l'existence du fichier
    if (!file_exists($path)) {
        return null; // Retourne null si le fichier n'existe pas
    }
    // Lecture et décodage du fichier JSON
    $content = file_get_contents($path);
    return json_decode($content, true); // Le paramètre true permet d'obtenir un tableau associatif plutôt qu'un objet
}

/**
 * Récupère un mot aléatoire d'une catégorie spécifique
 *
 * @param int $categoryIndex Index de la catégorie dans le tableau des clés
 * @return string Un mot aléatoire de la catégorie sélectionnée
 *
 * Processus :
 * 1. Récupère toutes les données du dictionnaire
 * 2. Obtient la clé (nom de catégorie) correspondant à l'index
 * 3. Sélectionne un mot aléatoire dans cette catégorie
 */
function retrieveARandomWordFromATableComposedOfTables(int $categoryIndex): string
{
    // Récupération des données du dictionnaire
    $data = getDataInJsonAndReturnByArrayData();

    // Récupération de la clé (nom de catégorie) à l'index spécifié
    $keys = array_keys($data);
    $chosenKey = $keys[$categoryIndex];

    // Sélection d'un mot aléatoire dans la catégorie
    $words = $data[$chosenKey];
    $randomIndex = array_rand($words);

    return $words[$randomIndex];
}

/**
 * Récupère les noms de toutes les catégories disponibles
 *
 * @return array Tableau contenant les noms de toutes les catégories
 *
 * Processus :
 * 1. Récupère toutes les données du dictionnaire
 * 2. Retourne les clés du tableau (qui représentent les noms de catégories)
 */
function getTheNameOfTheWordCategoryInAllData(): array
{
    // Récupération des données et extraction des clés (noms de catégories)
    $alldata = getDataInJsonAndReturnByArrayData();
    return array_keys($alldata);
}
?>
