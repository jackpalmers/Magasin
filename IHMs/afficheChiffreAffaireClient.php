<?php

include_once "navbar.php";
include_once "../Mapping/mappingClient.php";
include_once "../Mapping/mappingProduit.php";
include_once "../Service/serviceChiffreAffaireParClient.php";

function afficheClientAvecChiffreAffaire()
{
    $lstClientAvecChiffreAffaire = getClientAvecChiffreAffaire();
    $str = "";

    $str .= '<table class="table">';
    $str .= '    <thead class="thead-light">';
    $str .= '        <td colspan="4" style="text-align: center; background-color: #17a2b8">Clients avec chiffre d\'affaire</td>';
    $str .= '            <tr>';
    $str .= '                <th scope="col"></th>';
    $str .= '                <th scope="col">Client</th>';
    $str .= '                <th scope="col">Chiffre d\'affaire</th>';
    $str .= '            </tr>';
    $str .= '        </thead>';
    $str .= '    <tbody>';
    if ($lstClientAvecChiffreAffaire != null)
    {
        foreach ($lstClientAvecChiffreAffaire as $client)
        {
            $str .= '        <tr>';
            $str .= '            <th scope="row"></th>';
            $str .= '            <td>' . $client->nom . ' ' . $client->prenom . '</td>';
            $total = getTotalProduitByClient($client->id_client);
            $str .= '            <td>' . $total . ' €</td>';
            $str .= '        </tr>';
        }
    }
    else
    {
        $str .= '        <tr>';
        $str .= '            <td colspan="4" class="text-center">Il n\'existe pas de client avec du chiffre d\'affaire.</td>';
        $str .= '        </tr>';
    }
    $str .=  '    </tbody>';
    $str .=  '</table>';

    return $str;
}

function afficheClientSansChiffreAffaire()
{
    $lstClientAvecChiffreAffaire = getClientSansChiffreAffaire();
    $str = "";

    $str .= '<table class="table">';
    $str .= '    <thead class="thead-light">';
    $str .= '        <td colspan="4" style="text-align: center; background-color: #17a2b8">Clients sans chiffre d\'affaire</td>';
    $str .= '            <tr>';
    $str .= '                <th scope="col" style="text-align: center;">Client</th>';
    $str .= '            </tr>';
    $str .= '        </thead>';
    $str .= '    <tbody>';
    if ($lstClientAvecChiffreAffaire != null)
    {
        foreach ($lstClientAvecChiffreAffaire as $client)
        {
            $str .= '        <tr>';
            $str .= '            <td colspan="4" style="text-align: center;">' . $client->nom . ' ' . $client->prenom . '</td>';
            $str .= '        </tr>';
        }
    }
    else
    {
        $str .= '        <tr>';
        $str .= '            <td colspan="4" class="text-center">Il n\'existe pas de client sans chiffre d\'affaire.</td>';
        $str .= '        </tr>';
    }
    $str .=  '    </tbody>';
    $str .=  '</table>';

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
    <?php echo afficheClientAvecChiffreAffaire(); ?>
    <?php echo afficheClientSansChiffreAffaire(); ?>
    </body>
</html>
