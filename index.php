<?php
/**
 * Point de départ du jeu "Le Pendu".
 * Ce fichier lance simplement l'application.
 */

// Force PHP à vérifier strictement les types de données (évite les erreurs de conversion automatique)
declare(strict_types=1);

// Charge le cœur de l'application depuis le dossier "pendu"
require_once __DIR__ . '/pendu/app.php';

// Démarre le jeu (la fonction start() est définie dans app.php)
start();
?>
