<?php

include_once '../Mapping/mappingProduit.php';
include_once '../Mapping/mappingClient.php';

// Deux méthodes : Une retournant les clients avec et une autre sans chiffre d'affaire.
// Dupplication afin d'éviter une méthode générale retournant tout les clients dans le cas où l'on ne voudrait que l'un des 2 cas

function getClientAvecChiffreAffaire()
{
    $lstClient = getLstClients();
    $arrayClientAvecChiffreAffaire = null;
    $indice = 0;

    if ($lstClient != null)
    {
        foreach ($lstClient as $client)
        {
            $chiffreAffaire = getTotalProduitByClient($client->id_client);
            if ($chiffreAffaire)
            {
               $arrayClientAvecChiffreAffaire[$indice] = $client;
               $indice++;
            }
        }
    }

    return $arrayClientAvecChiffreAffaire;
}

function getClientSansChiffreAffaire()
{
    $lstClient = getLstClients();
    $arrayClientSansChiffreAffaire = null;
    $indice = 0;

    if ($lstClient != null) {
        foreach ($lstClient as $client) {
            $chiffreAffaire = getTotalProduitByClient($client->id_client);
            if (!$chiffreAffaire) {
                $arrayClientSansChiffreAffaire[$indice] = $client;
                $indice++;
            }
        }
    }

    return $arrayClientSansChiffreAffaire;
}