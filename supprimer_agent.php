<?php
session_start();

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'Admin') {
    header("Location: connexion.html");
    exit();
}

$database = "immobilier";
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    // On récupère la liste des agents 
    $sql = "SELECT * FROM agents";
    $result = mysqli_query($db_handle, $sql);

    echo '<style>
            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
            }
            th, td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }
            h1 {
                text-align: center;
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
          </style>';

    echo "<h1>Liste des Agents</h1>";

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Prénom</th><th>Nom</th><th>Email</th><th>Téléphone</th><th>Spécialité</th><th>Action</th></tr>';

        // On affiche les agents avec la possibilité pour les admins de les supprimer
        while ($agent = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $agent['Prénom'] . '</td>';
            echo '<td>' . $agent['Nom'] . '</td>';
            echo '<td>' . $agent['Email'] . '</td>';
            echo '<td>' . $agent['Téléphone'] . '</td>';
            echo '<td>' . $agent['Spécialité'] . '</td>';
            echo '<td><a href="suppression.php?id=' . $agent['ID_Agent'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet agent ?\')">Supprimer</a></td>';
            echo '</tr>';
        }

        echo '</table>';
         echo '<div class="center"><a href="ajouter_agent.html"><button>Ajouter un agent Immobilier</button></a></div>';
    } else {
        echo "<p>Aucun agent trouvé.</p>";
    }
} else {
    echo "Erreur lors de la connexion à la base de données.";
}

mysqli_close($db_handle);
?>
