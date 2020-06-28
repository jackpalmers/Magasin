<?php

include_once '../Mapping/mappingClient.php';
include_once '../Outils/date.php';

function afficherFormulaireInscription($message)
{

    $str = "";

    $str .= '<form class="form-horizontal" action="ajouterNouveauClient.php" method="POST">';
    $str .= '    <fieldset>';
    $str .= '        <div id="legend">';
    $str .= '            <legend class="">Ajout d\'un nouveau client</legend>';
    $str .= '        </div>';
    $str .= '        <div style="text-align: right;">';
    $str .= '           <input type="submit" class="btn btn-primary " value="Retour" onClick="javascript:history.go(-1)" />'; // Possible d'utiliser une balise <a href=""> pour rediriger vers la page souhaitée au lieu du Onclick
    $str .= '        </div>';
    $str .= '       <div style=" text-align: center;"><span style="font-style: italic; color: red;">' . $message . '</span></div>';
    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label"  for="nom">Nom : </label>';
    $str .= '            <div class="controls">';
    $str .= '                <input type="text" name="nom" class="input-xlarge">';
    $str .= '            </div>';
    $str .= '        </div>';

    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label" for="prenom">Prénom : </label>';
    $str .= '            <div class="controls">';
    $str .= '                <input type="text" name="prenom" class="input-xlarge">';
    $str .= '            </div>';
    $str .= '        </div>';

    $str .= '        <div class="control-group">';
    $str .= '            <label class="control-label" for="password">Date de naissance : </label>';
    $str .= '            <div class="controls">';
    $str .= '                <input type="text" name="date_naissance" id="datepicker">';
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

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                $( function() {
                    $( "#datepicker" ).datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                });
            </script>
    </head>
    <body>
    <?php

    if (!isset($message))
        $message = null;

    if (!isset($nom))
        $nom = null;

    if (!isset($prenom))
        $prenom = null;

    // Validation du formulaire d'ajout de client
    if(isset($_POST['submit']))
    {
        $error = false;

        if (isset($_POST['nom']) && $_POST['nom'] != '')
        {
            $nom = $_POST['nom'];
        }
        else
        {
            $message = 'Aucun nom saisi. ';
            $error = true;
        }

        if (isset($_POST['prenom']) && $_POST['prenom'] != '')
        {
            $prenom = $_POST['prenom'];
        }
        else
        {
            $message .= 'Aucun prénom saisi. ';
            $error = true;
        }

        // on regarde par le nom et le prénom que le client n'existe pas déjà
        $clientAlreadyExist = testIfClientAlreadyExist($nom, $prenom);
        if ($clientAlreadyExist)
        {
            $error = true;
            $message .= 'Ce client existe déjà. ';
        }

        if (isset($_POST['date_naissance']) && $_POST['date_naissance'] != '')
        {
            $dateNaissance = dateFormat($_POST['date_naissance']);
        }
        else
        {
            $message .= 'Aucune date de naissance saisie. ';
            $error = true;
        }

        if ($error != true)
        {
            $client = new Client;
            $client->Nom = $nom;
            $client->Prenom = $prenom;
            $client->DateNaissance = $dateNaissance;
            saveClient($client);

            header('Location: afficheListeClients.php');
        }
    }

    echo afficherFormulaireInscription($message);

    ?>
</body>