<?php
/**
 * Fichier : controllerGameData.php
 * Rôle : Couche intermédiaire de contrôle pour l'accès aux données du jeu.
 * Responsabilités :
 * - Fournit une interface simplifiée pour les vues
 * - Délègue les opérations complexes au modèle (data.php)
 * - Centralise les appels aux fonctions de gestion des données
 */

require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'data.php';

/**
 * Récupère les noms de toutes les catégories de mots disponibles.
 *
 * Cette fonction sert de passerelle entre la vue et le modèle.
 * Elle encapsule l'appel à la fonction de récupération des catégories.
 *
 * @return array Tableau contenant les noms de toutes les catégories
 *               Exemple : ["animaux", "pays", "fruits"]
 *
 * @see getTheNameOfTheWordCategoryInAllData() Fonction du modèle qui effectue le traitement
 */
function getTheNameOfTheWordCategory(): array
{
    return getTheNameOfTheWordCategoryInAllData();
}

/**
 * Sélectionne un mot aléatoire dans une catégorie spécifiée.
 *
 * Fonction d'abstraction qui masques les détails d'implémentation
 * et fournit une interface simple pour les vues.
 *
 * @param int $categoryIndex Index de la catégorie (1 pour la première catégorie)
 * @return string Un mot aléatoire de la catégorie demandée
 *
 * @throws RuntimeException Si la catégorie n'existe pas ou si le fichier de données est invalide
 *
 * @see retrieveARandomWordFromATableComposedOfTables() Fonction du modèle qui effectue le traitement
 */
function getRandomWordFromTheCategory(int $keys): string
{
    return retrieveARandomWordFromATableComposedOfTables($keys);
}
?>
