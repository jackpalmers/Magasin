<?php

include_once "navbar.php";
include_once "../Mapping/mappingProduit.php";
include_once "../Mapping/mappingClient.php";

function afficheListeProduit()
{
    $lstProduit = getLstProduits();

    $str = "";

    $str .=  '<table class="table">';
    $str .=  '    <thead class="thead-light">';
    $str .=  '        <tr>';
    $str .=  '            <th scope="col"></th>';
    $str .=  '            <th scope="col">Libelle</th>';
    $str .=  '            <th scope="col">Prix</th>';
    $str .=  '            <th scope="col">Client</th>';
    $str .=  '        </tr>';
    $str .=  '    </thead>';
    $str .=  '    <tbody>';
    if ($lstProduit != null)
    {
        foreach ($lstProduit as $produit)
        {
            $str .=  '        <tr>';
            $str .=  '            <th scope="row"></th>';
            $str .=  '            <td>' . $produit->libelle . '</td>';
            $str .=  '            <td>' . $produit->prix .' €</td>';
            $client = getClientById($produit->id_client);
            $str .=  '            <td>' . $client->Nom .' '. $client->Prenom . '</td>';
            $str .=  '        </tr>';
        }
    }
    else
    {
        $str .=  '        <tr>';
        $str .=  '            <td colspan="4" class="text-center">Il n\'existe pas de produit.</td>';
        $str .=  '        </tr>';
    }
    $str .=  '    </tbody>';
    $str .=  '</table>';
    $str .=  '<a href="ajouterNouveauProduit.php"><input type="submit" class="btn btn-info" value="Vendre un produit" </a>';

    return $str;
}

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../Css/bootstrap/css/bootstrap.css">
        <script src="../Css/bootstrap/js/bootstrap.js"></script>
        <script src="../Css/bootstrap/js/bootstrap.bundle.js"></script>
    </head>
    <body>
        <?php echo afficheListeProduit(); ?>
    </body>
</html>
