<?php
$database = "immobilier";
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

$properties = [];

if ($db_found) {
    $sql = "SELECT * FROM terrain";
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $properties[] = $row;
        }
    } else {
        echo "pas de résultat";
    }
    mysqli_close($db_handle);
} else {
    echo "Database not found";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Terrains à vendre</title>
    <meta charset="utf-8">
    <!-- Dernier CSS compilé et minifié -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <style>
        .corps {
            font-family: 'Playfair Display', serif;
            display: flex;
            flex-direction: column; 
            align-items: center; 
        }
        h1 {
            font-family: 'Playfair Display', serif;
            margin: 20px 0; 
            font-weight: 700;
            font-size: 2.5em; 
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            max-width: 1000px;
            margin-top: 20px; 
        }
        .gallery a {
            width: 24%;
            margin: 0.5%;
            box-sizing: border-box;
        }
        .gallery img {
            width: 100%;
            height: 150px; 
            object-fit: cover; 
            display: block;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; 
            height: 0;
            overflow: hidden;
            margin-top: 10px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .agents-gallery {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
        }
        .agent {
            text-align: center;
            margin: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(20% - 40px); 
            box-sizing: border-box;
        }
        .agent img {
            border-radius: 50%;
            margin-bottom: 15px;
            width: 100px;
            height: 100px; 
        }
        .agent h4 {
            margin-bottom: 10px;
        }
        .bouton {
            background-color: #007a7b;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body style="font-family: 'Playfair Display';
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
</nav>

<h1>Liste des Terrains</h1>
    <div class="gallery">
        <?php foreach ($properties as $property) { 
            // Enlever le premier chiffre du Num_Propriété
            $num_propriete = substr($property['Num_Propriété'], 1);
        ?>
            <a href="IR<?php echo $num_propriete; ?>.html"><img src="<?php echo $property['Photo']; ?>" alt="Property <?php echo $num_propriete; ?>"></a>
        <?php } ?>
    </div>
   </div>


        <h1>Nos Experts en Terrain</h1>
        <div class="agents-gallery">
            <div class="agent">
                <img src="agent6.png" alt="Agent 1">
                <h4> Pierre Martin </h4>
                <p>Expert en Terrain</p>
                <a href="agent6.html" class="bouton">Voir le profil</a>
            </div>
            <div class="agent">
                <img src="agent9.png" alt="Agent 2">
                <h4> Perrine Ronaldo </h4>
                <p>Expert en Terrain </p>
                <a href="agent9.html" class="bouton">Voir le profil</a>
            </div>
            <div class="agent">
                <img src="agent11.jpg" alt="Agent 3">
                <h4> Christian Lee </h4>
                <p>Expert en Terrain</p>
                <a href="agent11.html" class="bouton">Voir le profil</a>
            </div>
            <div class="agent">
                <img src="agent17.jpg" alt="Agent 4">
                <h4> Kyks Mbappinho </h4>
                <p>Expert en Terrain</p>
                <a href="agent17.html" class="bouton">Voir le profil</a>
            </div>
            <div class="agent">
                <img src="agent19.jpg" alt="Agent 5">
                <h4> Jean Neymar </h4>
                <p>Expert en Terrain</p>
                <a href="agent19.html" class="bouton">Voir le profil</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>


    <div style="background-color: #007a7b; 
            padding: 20px;
            margin: 0;
            width: 100%;
            color: white;">
            <div class="container">
            <div style="display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px 0;">
                <img src="logoB.png" class="media-object" width="150" height="100">
            </div>
            
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <b><h6 class="text-uppercase font-weight-bold">Informations additionnelles</h6></b>
                <ul>
                    <li><p>
                    Toutes tentatives de copies de ce site et de fraude en notre nom sera sanctionné de 70 000 euros d'amendes, en application de l'article 41.39,2 du Code de la propriété  Intellectuelle.
                    <p></li>
                    <li><p>Toutes vos données sont protégées en accord avec le RGPD.
                    </p></li>
                </ul>
                
            </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
     <b><h6 class="text-uppercase font-weight-bold">Contact</h6></b>
     <p>
     37, quai de Grenelle, 75015 Paris, France <br>
     <a href="mailto:omnes.immobilier@gmail.com">omnes.immobilier@gmail.com</a> <br>
     +33 01 02 03 04 05 <br>
     +33 01 03 02 05 04
    </p>
        </div>
    </div>
    <br>
    <div class="footer-copyright text-center">&copy; 2024 Copyright | Droit d'auteur: Omnes Immobilier</div>
    <br>
    <br>
        </div>
    </div>
    
</body>
</html>
