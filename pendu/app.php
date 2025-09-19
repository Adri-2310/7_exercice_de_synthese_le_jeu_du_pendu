<?php
/*
    Fichier principal du jeu du Pendu.
    Gère l'initialisation du jeu, l'affichage du menu et le déroulement d'une partie.
*/

// Inclusion des dépendances nécessaires
require_once __DIR__ . DIRECTORY_SEPARATOR .'controllers'.DIRECTORY_SEPARATOR.'controllerGameData.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'views'.DIRECTORY_SEPARATOR.'viewGameMenu.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .'views'.DIRECTORY_SEPARATOR.'viewGame.php';

/**
 * Lance une nouvelle partie du jeu du Pendu.
 *
 * Cette fonction effectue le déroulement complet d'une partie :
 * 1. Affiche le menu de sélection de difficulté et récupère le mot à deviner
 * 2. Initialise les variables de jeu (mot caché, vies restantes, lettres utilisées)
 * 3. Affiche l'interface de jeu initiale
 *
 * @return void
 */
function start(): void
{
    // Étape 1 : Affichage du menu et sélection du mot
    // La fonction displayGameMenu() retourne le mot à deviner en fonction du choix de catégorie
    $wordsFound = displayGameMenu();

    // Étape 2 : Préparation du jeu
    // Crée une version masquée du mot (ex: "test" devient "****")
    $hiddenWords = createHiddenWord($wordsFound);

    // Initialisation des paramètres de jeu :
    // - 6 vies (têtes de pendu classiques)
    // - Chaîne vide pour stocker les lettres déjà proposées
    $livesRemaining = 6;
    $letterUsed = "";

    // Étape 3 : Lancement de l'interface de jeu
    // Affiche le mot masqué, les vies restantes et les lettres utilisées
    // Note : La logique de saisie des lettres et de mise à jour sera implémentée ultérieurement
    displayGame($hiddenWords, $livesRemaining, $letterUsed);

    // TODO : Implémenter la boucle de jeu principale qui :
    // 1. Demande une lettre à l'utilisateur
    $ChosenLetter = getLetterFromUser();
    $result =checkTheLetterIsInTheWords($ChosenLetter,$wordsFound);

}



?>
