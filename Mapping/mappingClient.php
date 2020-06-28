<?php

include_once '../Classes/Client.php';
include_once '../connexion.php';
include_once '../Outils/string.php';

// Attribution des données récupérées aux propriétés de l'objet
function createInstanceClient($data)
{
    $client = new Client();
    $client->IdClient = $data->id_client;
    $client->Nom = $data->nom;
    $client->Prenom = $data->prenom;
    $client->DateNaissance = date($data->date_naissance);

    return $client;
}

function getLstClients()
{
    $db = connect();

    $request = $db->query('SELECT * FROM client');
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    $arrayClients = null;
    if (count($result) > 0) {
        $indice = 0;
        foreach ($result as $client) {
            createInstanceClient($client);
            $arrayClients[$indice] = $client;
            $indice++;
        }
    }

    return $arrayClients;
}


function getClientById($idClient)
{
    $client = null;
    $db = connect();

    $request = $db->query('SELECT * FROM client WHERE id_client = '.$idClient);
    $result = $request->fetchObject();
    if ($result != null)
        $client = createInstanceClient($result);

    return $client;
}

function testIfClientAlreadyExist($nom, $prenom)
{
    $db = connect();

    $exist = false;
    $request = $db->query("SELECT * FROM client WHERE nom = '". $nom ."' AND prenom = '". $prenom ."'");
    $result = $request->fetchObject();

    // on retourne true si l'on trouve un client en base avec un nom et prénom similaire à ceux saisis.
    if ($result)
        $exist = true;

    return $exist;
}

function saveClient(Client $client)
{
    $db = connect();

    $query = $db->prepare( 'INSERT INTO client (nom, prenom, date_naissance) VALUES (:nom, :prenom, :date_naissance)');
    $query->bindValue(':nom', verifyString($client->Nom), PDO::PARAM_STR);
    $query->bindValue(':prenom', verifyString($client->Prenom), PDO::PARAM_STR);
    $query->bindValue(':date_naissance', verifyString($client->DateNaissance), PDO::PARAM_STR);
    $query->execute();
}