<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'data.php';
function getTheNameOfTheWordCategory(): array{
    return getTheNameOfTheWordCategoryInAllData();
}

function getRandomWordFromTheCategory(int $keys): string{
    return retrieveARandomWordFromATableComposedOfTables($keys);
}
?>