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
    if (isset($_GET['id'])) {
        $property_id = intval($_GET['id']);

        // On supprime le bien résidentiel à l'aide de son ID
        $sql = "DELETE FROM i_résidentiel WHERE Num_Propriété = $property_id";
        if (mysqli_query($db_handle, $sql)) {
            echo "Propriété résidentielle supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de la propriété résidentielle.";
        }
    } else {
        echo "ID de propriété résidentielle non spécifié.";
    }
} else {
    echo "Erreur lors de la connexion à la base de données.";
}

mysqli_close($db_handle);

header("Location: liste_bien.php");
exit();
?>
