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
    // On affiche les biens résidentiels
    $sql_residentiel = "SELECT * FROM i_résidentiel";
    $result_residentiel = mysqli_query($db_handle, $sql_residentiel);

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

    echo "<h1>Liste des Propriétés Résidentielles</h1>";
    if (mysqli_num_rows($result_residentiel) > 0) {
        echo '<table>';
        echo '<tr><th>Numéro de Propriété</th><th>Nombre de pièces</th><th>Nombre de chambres</th><th>Dimension</th><th>Étage</th><th>Balcon</th><th>Parking</th><th>Adresse</th><th>Montant</th><th>Photo</th><th>Action</th></tr>';
        while ($property = mysqli_fetch_assoc($result_residentiel)) {
            echo '<tr>';
            echo '<td>' . $property['Num_Propriété'] . '</td>';
            echo '<td>' . $property['N_pieces'] . '</td>';
            echo '<td>' . $property['N_chambres'] . '</td>';
            echo '<td>' . $property['Dimension'] . '</td>';
            echo '<td>' . $property['Etage'] . '</td>';
            echo '<td>' . $property['Balcon'] . '</td>';
            echo '<td>' . $property['Parking'] . '</td>';
            echo '<td>' . $property['Adresse'] . '</td>';
            echo '<td>' . $property['Montant'] . '</td>';
            echo '<td><img src="' . $property['Photo'] . '" alt="Photo" width="100"></td>';
            echo '<td><a href="suppression_IR.php?id=' . $property['Num_Propriété'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette propriété ?\')">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div class="center"><a href="ajouter_IR.html"><button>Ajouter un bien résidentiel</button></a></div>';
    } else {
        echo "<p>Aucune propriété résidentielle trouvée.</p>";
    }

    // On affiche les biens commerciaux
    $sql_commercial = "SELECT * FROM i_commercial";
    $result_commercial = mysqli_query($db_handle, $sql_commercial);
    echo "<h1>Liste des Propriétés Commerciales</h1>";
    if (mysqli_num_rows($result_commercial) > 0) {
        echo '<table>';
        echo '<tr><th>Numéro de Propriété</th><th>Type</th><th>Surface</th><th>Nombre de Bureaux</th><th>Salle de Réunion</th><th>Étage</th><th>Parking</th><th>Adresse</th><th>Montant</th><th>Photo</th><th>Action</th></tr>';
        while ($property = mysqli_fetch_assoc($result_commercial)) {
            echo '<tr>';
            echo '<td>' . $property['Num_Propriété'] . '</td>';
            echo '<td>' . $property['Type'] . '</td>';
            echo '<td>' . $property['Surface'] . '</td>';
            echo '<td>' . $property['Nb_Bureau'] . '</td>';
            echo '<td>' . $property['Salle_reunion'] . '</td>';
            echo '<td>' . $property['Etage'] . '</td>';
            echo '<td>' . $property['Parking'] . '</td>';
            echo '<td>' . $property['Adresse'] . '</td>';
            echo '<td>' . $property['Montant'] . '</td>';
            echo '<td><img src="' . $property['Photo'] . '" alt="Photo" width="100"></td>';
            echo '<td><a href="suppression_IC.php?id=' . $property['Num_Propriété'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette propriété ?\')">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div class="center"><a href="ajouter_IC.html"><button>Ajouter un bien commercial</button></a></div>';
    } else {
        echo "<p>Aucune propriété commerciale trouvée.</p>";
    }

    // On affiche les terrains
    $sql_terrain = "SELECT * FROM terrain";
    $result_terrain = mysqli_query($db_handle, $sql_terrain);
    echo "<h1>Liste des Terrains</h1>";
    if (mysqli_num_rows($result_terrain) > 0) {
        echo '<table>';
        echo '<tr><th>Numéro de Propriété</th><th>Surface</th><th>Localisation</th><th>Adresse</th><th>Montant</th><th>Photo</th><th>Action</th></tr>';
        while ($property = mysqli_fetch_assoc($result_terrain)) {
            echo '<tr>';
            echo '<td>' . $property['Num_Propriété'] . '</td>';
            echo '<td>' . $property['Surface'] . '</td>';
            echo '<td>' . $property['Localisation'] . '</td>';
            echo '<td>' . $property['Adresse'] . '</td>';
            echo '<td>' . $property['Montant'] . '</td>';
            echo '<td><img src="' . $property['Photo'] . '" alt="Photo" width="100"></td>';
            echo '<td><a href="suppression_T.php?id=' . $property['Num_Propriété'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce terrain ?\')">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div class="center"><a href="ajouter_T.html"><button>Ajouter un terrain</button></a></div>';
    } else {
        echo "<p>Aucun terrain trouvé.</p>";
    }

    // On affiche les appartements à louer
    $sql_alouer = "SELECT * FROM a_louer";
    $result_alouer = mysqli_query($db_handle, $sql_alouer);
    echo "<h1>Liste des Propriétés à Louer</h1>";
    if (mysqli_num_rows($result_alouer) > 0) {
        echo '<table>';
        echo '<tr><th>Numéro de Propriété</th><th>Nombre de pièces</th><th>Nombre de chambres</th><th>Surface</th><th>Étage</th><th>Balcon</th><th>Parking</th><th>Adresse</th><th>Montant</th><th>Photo</th><th>Action</th></tr>';
        while ($property = mysqli_fetch_assoc($result_alouer)) {
            echo '<tr>';
            echo '<td>' . $property['Num_Propriété'] . '</td>';
            echo '<td>' . $property['N_pieces'] . '</td>';
            echo '<td>' . $property['N_chambres'] . '</td>';
            echo '<td>' . $property['Surface'] . '</td>';
            echo '<td>' . $property['Etage'] . '</td>';
            echo '<td>' . $property['Balcon'] . '</td>';
            echo '<td>' . $property['Parking'] . '</td>';
            echo '<td>' . $property['Adresse'] . '</td>';
            echo '<td>' . $property['Montant'] . '</td>';
            echo '<td><img src="' . $property['Photo'] . '" alt="Photo" width="100"></td>';
            echo '<td><a href="suppression_AL.php?id=' . $property['Num_Propriété'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette propriété ?\')">Supprimer</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div class="center"><a href="ajouter_AL.html"><button>Ajouter un appartement à louer</button></a></div>';
    } else {
        echo "<p>Aucune propriété à louer trouvée.</p>";
    }
} else {
    echo "Erreur lors de la connexion à la base de données.";
}

mysqli_close($db_handle);
?>
