<?php
/**
 * Point d'entrée principal de l'application "Jeu du Pendu".
 *
 * Ce fichier initialise l'application avec :
 * - La déclaration stricte des types (strict_types)
 * - Le chargement des dépendances nécessaires
 * - L'exécution du point d'entrée principal
 */

// Activation du typage strict pour tout le projet
declare(strict_types=1);

// Chargement du cœur de l'application
require_once __DIR__.DIRECTORY_SEPARATOR.'pendu'.DIRECTORY_SEPARATOR.'app.php';

/*
 * Initialisation et lancement du jeu :
 * 1. Charge les dépendances via le require_once ci-dessus
 * 2. Appelle la fonction start() définie dans 'pendu/app.php'
 *    qui contient la logique principale du jeu
 * 3. La fonction start() gère :
 *    - L'affichage du menu principal
 *    - La sélection du mot à deviner
 *    - Le déroulement de la partie
 */
start();
?>
