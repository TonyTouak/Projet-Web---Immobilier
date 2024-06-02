<?php

if(isset($_POST["Envoyer"])){
$destinataire = isset($_POST["agentEmail"])? $_POST["agentEmail"] : "";

$expediteur=isset($_POST["yourEmail"])? $_POST["yourEmail"] : "";
//$destinataire="rogue.pink78@gmail.com";

$sujet= isset($_POST["sujet"])? $_POST["sujet"] : "";;

$message= isset($_POST["message"])? $_POST["message"] : "";

$message= "Email du client : ". $expediteur ."\n\n". $message;



$headers="Content-Type: text/plain; charset=utf-8\r\n";

$headers .="From: raphaelgilon78@gmail.com\r\n";

echo '<!DOCTYPE html>
<html>
<head>
<title>Accueil</title>
<meta charset="utf-8">
    <!-- Dernier CSS compilé et minifié -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</style>
</head>
<body style="font-family: "Playfair Display";
         font-size: 17px;">
<div class="container-fluid" >

<div style="text-align: center;
            background-color: white;
            padding: 20px;
            border-bottom: 1px solid #007a7b;">
    <div class="logo">
        <img src="logo.png" alt="logo" style="  height: 100px;">
    </div>
    <div style=" color: #007a7b;
            font-size: 40px;
            font-weight: bold;
            margin-top: 10px;">
        OMNES Immobilier
    </div>
</div>

<nav style="background-color: #007a7b;
            padding: 10px 0;">
    <ul style="list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;">
        <li style=" margin: 0 15px;"><a href="accueil.html" style="color: white;
            text-decoration: none;
            font-size: 18px;">Accueil</a></li>
        <li style=" margin: 0 15px;"><a href="parcourir.html" style="color: white;
            text-decoration: none;
            font-size: 18px;">Tout Parcourir</a></li>
        <li style=" margin: 0 15px;"><a href="rechercher.html" style="color: white;
            text-decoration: none;
            font-size: 18px;">Rechercher</a></li>
        <li style=" margin: 0 15px;"><a href="rendezvous.php" style="color: white;
            text-decoration: none;
            font-size: 18px;">Rendez-vous</a></li>
        <li style=" margin: 0 15px;"><a href="moncompte.php" style="color: white;
            text-decoration: none;
            font-size: 18px;">Mon Compte</a></li>
    </ul>
</nav> <br> <br> <br> <br> <br> <br> <br> '
;

if(mail($destinataire, $sujet, $message, $headers)){
    if (mail($destinataire, $sujet, $message, $headers)) {
        echo '<p style="text-align: center; font-weight: bold; text-decoration: underline;">Mail envoyé avec succès !</p>';
        echo '<br><br>';
    } else {
        echo '<p style="text-align: center; font-weight: bold; text-decoration: underline;">Erreur dans l\'envoi du mail</p>';
    }


    echo '<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <hr ALIGN=CENTER WIDTH="500" style="border: 1px solid #007a7b">
    <div style="background-color: #007a7b; padding: 20px; margin: 0; width: 100%; color: white;">
        <div class="container">
            <div style="display: flex; justify-content: center; align-items: center; padding: 20px 0;">
                <img src="logoB.png" class="media-object" width="150" height="100">
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <b><h6 class="text-uppercase font-weight-bold">Informations additionnelles</h6></b>
                    <ul>
                        <li><p>Toutes tentatives de copies de ce site et de fraude en notre nom seront sanctionnées de 70 000 euros d\'amende, en application de l\'article 41.39,2 du Code de la propriété intellectuelle.</p></li>
                        <li><p>Toutes vos données sont protégées en accord avec le RGPD.</p></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <b><h6 class="text-uppercase font-weight-bold">Contact</h6></b>
                    <p>37, quai de Grenelle, 75015 Paris, France <br>
                    <a href="mailto:omnes.immobilier@gmail.com">omnes.immobilier@gmail.com</a> <br>
                    +33 01 02 03 04 05 <br>
                    +33 01 03 02 05 04</p>
                </div>
            </div>
            <br>
            <div class="footer-copyright text-center">&copy; 2024 Copyright | Droit d\'auteur: Omnes Immobilier</div>
            <br><br>
        </div>
    </div>
</body>
</html>';
}
}
?>