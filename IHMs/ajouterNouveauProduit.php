<?php

include '../Mapping/mappingProduit.php';
include '../Mapping/mappingClient.php';

function afficherFormulaireAjoutProduit($message)
{

    $str = "";

    $str .= '<form class="form-horizontal" action="ajouterNouveauProduit.php" method="POST">';
    $str .= '    <fieldset>';
    $str .= '        <div id="legend">';
    $str .= '            <legend class="">Ajout d\'un nouveau produit</legend>';
    $str .= '        </div>';
    $str .= '        <div style="text-align: right;">';
    $str .= '           <input type="submit" class="btn btn-primary " value="Retour" onClick="javascript:history.go(-1)" />'; // Possible d'utiliser une balise <a href=""> pour rediriger vers la page souhaitée au lieu du Onclick
    $str .= '        </div>';

    $str .= '       <div style=" text-align: center;"><span style="font-style: italic; color: red;">' . $message . '</span></div>';
    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label"  for="libelle">Libelle : </label>';
    $str .= '            <div class="controls">';
    $str .= '                <input type="text" name="libelle" class="input-xlarge">';
    $str .= '            </div>';
    $str .= '        </div>';

    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label" for="prix">Prix : </label>';
    $str .= '            <div class="controls">';
    $str .= '                <input type="text" name="prix" class="input-xlarge">';
    $str .= '            </div>';
    $str .= '        </div>';
    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label" for="id_client">Client : </label>';
    $str .= '            <div class="controls">';
    $str .= '               <select name=id_client>';
    $lstClient = getLstClients();
    if ($lstClient != null)
    {
        foreach($lstClient as $client)
        {
            $str .= '               <option value='. $client->id_client .'> '. $client->nom .' '. $client->prenom .'</option>';
        }
    }
    else
    {
        $str .= '               <option value="0">Aucun client trouvé en base</option>';
    }
    $str .= '               </select>';
    $str .= '            </div>';
    $str .= '        </div>';

    $str .= '        <div class="control-group">';
    $str .= '            <div class="controls">';
    $str .= '                <button class="btn btn-success" type="submit" name="submit">Valider</button>';
    $str .= '            </div>';
    $str .= '        </div>';
    $str .= '    </fieldset>';
    $str .= '</form>';

    return $str;
}

?>
<html>
    <head>
        <meta charset="utf8" />
            <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
    <?php

    if(!isset($message))
        $message = null;

    // Validation du formulaire d'ajout de produit
    if(isset($_POST['submit']))
    {
        $error = false;

        if (isset($_POST['libelle']) && $_POST['libelle'] != '')
        {
            $libelle = $_POST['libelle'];
        }
        else
        {
            $message = 'Aucun libelle saisi. ';
            $error = true;
        }

        if (isset($_POST['prix']) && $_POST['prix'] > 0)
        {
            $prix = $_POST['prix'];
        }
        else
        {
            $message .= 'Aucun prix saisi. ';
            $error = true;
        }

        if (isset($_POST['id_client']) && $_POST['id_client'] != 0) // id 0 équivaut à la valeur attribuée lorsqu'il n'existe pas de client en base
        {
            $id_client = $_POST['id_client'];
        }
        else
        {
            $message .= 'Aucun client saisi. ';
            $error = true;
        }

        if ($error != true)
        {
            $produit = new Produit();
            $produit->Libelle = $libelle;
            $produit->Prix = $prix;
            $produit->IdClient = $id_client;

            saveProduit($produit);

            header('Location: afficheListeProduits.php');
        }
    }

    echo afficherFormulaireAjoutProduit($message);

    ?>
    </body>
</html>