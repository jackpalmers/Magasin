<?php

// Permet de faire différent test sur la chaine avant son insertion en base de données
function verifyString($string)
{
    $escapeSpace = trim($string);
    $escapeSpecialChar = htmlentities($escapeSpace);

    return $escapeSpecialChar;
}
