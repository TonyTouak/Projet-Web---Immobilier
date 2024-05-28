<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que client
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'Client') {
    header("Location: connexion.html");
    exit();
}

// Connexion à la base de données
$database = "immobilier";
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    // Récupérer l'email du client à partir de la session
    $email = $_SESSION['Email'];

    // Requête SQL pour récupérer toutes les informations du client
    $sql = "SELECT * FROM client WHERE Email = '$email'";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        // Récupérer les données du client
        $client = mysqli_fetch_assoc($result);
        echo '<style>
                        p {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #f9f9f9;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        h1 {
                            font-family: Playfair Display;
                            text-align : center;
                        }
                      </style>';

        // Afficher toutes les informations du client
        echo "<h1>Bienvenue sur votre Espace Client</h1>";
        echo "<p>Prénom : " . $client['Prénom'] . "</p>";
        echo "<p>Nom : " . $client['Nom'] . "</p>";
        echo "<p>Email : " . $client['Email'] . "</p>";
        echo "<p>Adresse1 : " . $client['Adresse1'] . "</p>";
        echo "<p>Adresse2 : " . $client['Adresse2'] . "</p>";
        echo "<p>Téléphone : 0" . $client['Téléphone'] . "</p>";
        echo "<p>Ville : " . $client['Ville'] . "</p>";
        echo "<p>Code Postal : " . $client['Code_Postal'] . "</p>";
        echo "<p>Pays : " . $client['Pays'] . "</p>";
        // Afficher d'autres informations du client selon vos besoins
    } else {
        echo "Erreur lors de la récupération des informations du client.";
    }
} else {
    echo "Erreur lors de la connexion à la base de données.";
}

// Fermer la connexion à la base de données
mysqli_close($db_handle);
?>