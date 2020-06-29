<?php

include_once "navbar.php";
include_once "../Mapping/mappingClient.php";
include_once "../Mapping/mappingProduit.php";

function afficheClientChiffreAffaire()
{
    $lstClient = newGetTotalProduitByClient();
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
    if ($lstClient != null)
    {
        foreach ($lstClient as $client)
        {
            $str .= '        <tr>';
            $str .= '            <th scope="row"></th>';
            $str .= '            <td>' . $client->nom . ' ' . $client->prenom . '</td>';
            $euro = '';
            if ($client->total != null)
                $euro = '€';
            $str .= '            <td>' . $client->total . ' ' . $euro . ' </td>';
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

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../Css/bootstrap/css/bootstrap.css">
        <script src="../Css/bootstrap/js/bootstrap.js"></script>
        <script src="../Css/bootstrap/js/bootstrap.bundle.js"></script>
    </head>
    <body>
    <?php echo afficheClientChiffreAffaire(); ?>
    </body>
</html>
