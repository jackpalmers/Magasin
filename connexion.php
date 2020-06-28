<?php

function connect()
{
    try
    {
        $db = new PDO('mysql:host=localhost:3308; dbname=db_magasin', 'root', 'root'); // => A changer
    }

    catch(exception $e)
    {
        die('Erreur '.$e->getMessage());
    }

    return $db;
}
