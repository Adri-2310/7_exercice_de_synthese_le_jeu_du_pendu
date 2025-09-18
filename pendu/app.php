<?php
/*
    Ce fichier contient la fonction principale du jeu du pendu.
*/

/**
 * Lit un fichier JSON à partir du chemin spécifié et retourne son contenu sous forme de tableau associatif.
 *
 * @param string $path Le chemin du fichier JSON à lire.
 * @return array|null Le contenu décodé du JSON sous forme de tableau associatif, ou null en cas d'échec.
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
 * @return string|null Un mot aléatoire ou null si le tableau est vide ou si la catégorie est invalide.
 */
function retrieveARandomWordFromATableComposedOfTables(array $data): ?string
{
    $keys = array_keys($data);
    echo "Les catégories suivantes de mots sont disponibles :" . PHP_EOL;
    for ($i = 0, $iMax = count($keys); $i < $iMax; $i++) {
        echo ((string)($i + 1)) . " " . $keys[$i] . PHP_EOL;
    }
    $isValid = false;
    // Boucle pour redemander la catégorie en cas d'erreur
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

function start(): void
{
    echo "Bonjour ! Bienvenue dans le jeu du pendu." . PHP_EOL;
    $result = getDataInJsonAndReturnByArrayData(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data/dictionnaire.json");
    if ($result === null) {
        echo "Erreur : impossible de charger le dictionnaire." . PHP_EOL;
        return;
    }

    $wordSelected = retrieveARandomWordFromATableComposedOfTables($result);
}
?>
