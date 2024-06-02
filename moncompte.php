<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <!-- Dernier CSS compilé et minifié -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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



<?php
session_start();

if (!isset($_SESSION['userType']) || ($_SESSION['userType'] !== 'Client' && $_SESSION['userType'] !== 'Agents' && $_SESSION['userType'] !== 'Admin')) {
    header("Location: connexion.html");
    exit();
}

$database = "immobilier";
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    $email = $_SESSION['Email'];
    $userType = $_SESSION['userType'];
    $table = strtolower($userType);

    // On récupère toutes les données de l'utilisateur dans la BDD grâce à son email
    $sql = "SELECT * FROM $table WHERE Email = '$email'";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        echo '<style>
                .php p {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .php h1 {
                    text-align: center;
                    color: #007a7b;
                }
                .center {
                    display: flex;
                    justify-content: center;
                }
                .center button {
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
                .logout {
                    text-align: center;
                    margin: 20px;
                }
                .logout form button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #f44336;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
              </style>';

        // Affichage des informations de l'utilisateur en fonction de son type
        echo "<div class='php'>";
        echo "<h1>Bienvenue sur votre Espace $userType</h1>";
        echo "<p>Prénom : " . $user['Prénom'] . "</p>";
        echo "<p>Nom : " . $user['Nom'] . "</p>";
        echo "<p>Email : " . $user['Email'] . "</p>";

        if ($userType == 'Client') {
            echo "<p>Téléphone : 0" . $user['Téléphone'] . "</p>";
            echo "<p>Adresse1 : " . $user['Adresse1'] . "</p>";
            echo "<p>Adresse2 : " . $user['Adresse2'] . "</p>";
            echo "<p>Ville : " . $user['Ville'] . "</p>";
            echo "<p>Code Postal : " . $user['Code_Postal'] . "</p>";
            echo "<p>Pays : " . $user['Pays'] . "</p>";
            $client_id = $user['ID_Client'];
            $sql_solde = "SELECT Solde FROM paiement WHERE ID_Client = '$client_id'";
            $result_solde = mysqli_query($db_handle, $sql_solde);

            if ($result_solde) {
                $solde_row = mysqli_fetch_assoc($result_solde);
                $solde_client = $solde_row['Solde'];
                echo "<p>Solde : $solde_client €</p>";}
            echo "<br>";
            echo '<div class="center"><a href="rendezvous.php"><button>Afficher vos rdv</button></a></div>';
            echo "</div>";
        } elseif ($userType == 'Agents') {
            echo "<p>Téléphone : 0" . $user['Téléphone'] . "</p>";
            echo "<p>Spécialité : " . $user['Spécialité'] . "</p>";
            echo '<div class="center"><a href="rendezvous.php"><button>Voir vos RDV</button></a></div>';
            echo "</div>";
        } elseif ($userType == 'Admin') {
            echo '<div class="center"><a href="supprimer_agent.php"><button>Accéder à la liste des agents</button></a></div>';
            echo '<div class="center"><a href="liste_bien.php"><button>Accéder à la liste des biens immobiliers</button></a></div>';
            echo "</div>";
        }
        echo '<div class="logout">
        <form method="POST" action="deconnexion.php">
            <button type="submit">Se déconnecter</button>
        </form>
      </div>';
    } else {
        echo "Erreur lors de la récupération des informations.";
    }
} else {
    echo "Erreur lors de la connexion à la base de données.";
}
mysqli_close($db_handle);
?>



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


