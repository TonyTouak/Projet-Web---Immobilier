<?php
session_start();

// Identifier le nom de la base de données
$database = "immobilier";

// Connexion à la base de données
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

// Vérifier si la base de données existe
if ($db_found) {
    // Récupérer les informations du formulaire
    $userType = mysqli_real_escape_string($db_handle, $_POST['userType']);
    $Email = mysqli_real_escape_string($db_handle, $_POST['Email']);
    $password = mysqli_real_escape_string($db_handle, $_POST['password']);
    
    // Déterminer la table en fonction du type d'utilisateur
    $table = "";
    if ($userType == "Client") {
        $table = "client";
    } 
    else if ($userType == "Admin") {
        $table = "admin";
    } 
    else if ($userType == "Agent") {
        $table = "agent";
    } 
    echo "Table: " . $table . "<br>";
    echo "Email: " . $Email . "<br>";
    echo "password: " . $password . "<br>";


    // Vérifier les informations de connexion
    $sql = "SELECT * FROM $table WHERE Email = '$Email' AND Mot_de_passe = '$password'";
    $result = mysqli_query($db_handle, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
            // Connexion réussie
            $_SESSION['userType'] = $userType;
            $_SESSION['Email'] = $Email;
            
            // Redirection en fonction du type d'utilisateur
            if ($userType == "Client") {
                header("Location: moncompte.php");
            } elseif ($userType == "Admin") {
                header("Location: admin_dashboard.php");
            } elseif ($userType == "Agent") {
                header("Location: agent_dashboard.php");
            }
            exit();
        
    } 

    else {
        echo "Email ou mot de passe incorrect.";
    }
} 
else {
    echo "Database not found";
}

// Fermer la connexion
mysqli_close($db_handle);
?>
