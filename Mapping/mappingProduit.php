<?php

include_once '../Classes/Produit.php';
include_once '../connexion.php';
include_once '../Outils/string.php';

function createInstanceProduit($data)
{
    $produit = new Produit();

    $produit->IdProduit = $data->id_produit;
    $produit->Libelle = $data->libelle;
    $produit->Prix = $data->prix;
    $produit->IdClient = $data->id_client;

    return $produit;
}

function getLstProduits()
{
    $db = connect();

    $request = $db->query('SELECT * FROM produit');
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    $arrayProduits = null;
    if (count($result) > 0) {
        $indice = 0;
        foreach ($result as $produit) {
            createInstanceProduit($produit);
            $arrayProduits[$indice] = $produit;
            $indice++;
        }
    }
    return $arrayProduits;
}

function newGetTotalProduitByClient()
{
    $db = connect();

    $request = $db->query ('SELECT client.nom, client.prenom, SUM(produit.prix) as total FROM client LEFT JOIN produit ON client.id_client = produit.id_client GROUP BY client.id_client');
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    return $result;
}

function getTotalProduitByClient($idClient)
{
    $db = connect();

    $request = $db->query('SELECT SUM(prix) as total FROM produit where id_client = '. $idClient);
    $result = $request->fetchColumn();

    return $result;
}

function saveProduit(Produit $produit)
{
    $db = connect();

    $query = $db->prepare( 'INSERT INTO produit (libelle, prix, id_client) VALUES (:libelle, :prix, :id_client)');
    $query->bindValue(':libelle', verifyString($produit->Libelle), PDO::PARAM_STR);
    $query->bindValue(':prix', $produit->Prix, PDO::PARAM_INT); //
    $query->bindValue(':id_client', $produit->IdClient, PDO::PARAM_INT);
    $query->execute();
}