<?php
//var_dump($_POST);
require 'vendor/autoload.php';

// Les namespaces utilisés
use Dompdf\Dompdf;
use Dompdf\Options;

// Configurations Dompdf
$options = new Options();
$options ->set("isHTML5ParserEnabled", true);
$options ->set("isRemotedEnabled", true);

// Céation d'un objet Dompdf
$dompdf = new Dompdf($options);


// on défini le contenu HTML/CSS qui va représenter notre pdf
$html= '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif du formulaire</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
        }
        .container{
            width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 100px 20px;
        }
        .titre{
            text-align: center;
            font-size: 18px;
            font-weight:bold;
            margin-bottom: 20px;
        }
        .contenu{
            margin-top:20px;

        }
        footer{
            padding:10px;
            text-align: center;
            position:absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titre">Récapitulatif de votre formulaire</h1>
        <div class="contenu">
            <p>Nom: '.$_POST['nom'].'</p>
            <p>Email: '.$_POST['email'].'</p>
            <p>Message: '.$_POST['message'].'</p>
        </div>
        <footer>Visa Card copyRight &copy 2024</footer>
    </div>
</body>
</html>
';
$dompdf ->loadHtml($html);
$dompdf ->setPaper("A4", 'portrait');
$dompdf ->render();

$ddpOutput = $dompdf ->output();
$filePath= "formulaire_recap.pdf";

file_put_contents($filePath, $ddpOutput);

include "sendMail.php";

