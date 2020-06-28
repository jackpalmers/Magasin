<?php

include_once "navbar.php";
include_once "../Mapping/mappingClient.php";

function afficheListeCLient()
{
    $lstClient = getLstClients();

    $str = "";

    $str .= '<table class="table">';
    $str .= '    <thead class="thead-light">';
    $str .= '        <tr>';
    $str .= '            <th scope="col"></th>';
    $str .= '            <th scope="col">Nom</th>';
    $str .= '            <th scope="col">Prénom</th>';
    $str .= '            <th scope="col">Date de naissance</th>';
    $str .= '        </tr>';
    $str .= '    </thead>';
    $str .= '    <tbody>';
    if ($lstClient != null)
    {
        foreach ($lstClient as $client)
        {
            $str .= '        <tr>';
            $str .= '            <th scope="row"></th>';
            $str .= '            <td>' . $client->nom . '</td>';
            $str .= '            <td>' . $client->prenom . '</td>';
            $str .= '            <td>' . $client->date_naissance . '</td>';
            $str .= '        </tr>';
        }
    }
    else
    {
        $str .= '        <tr>';
        $str .= '            <td colspan="4" class="text-center">Il n\'existe pas de client.</td>';
        $str .= '        </tr>';
    }
    $str .=  '    </tbody>';
    $str .=  '</table>';

    $str .=  '<a href="ajouterNouveauClient.php"><input type="submit" class="btn btn-info" value="Ajouter un client" </a>';

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
        <?php echo afficheListeCLient(); ?>
    </body>
</html>
