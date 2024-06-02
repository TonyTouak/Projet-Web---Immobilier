<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $database = "immobilier";
    $db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
    $db_found = mysqli_select_db($db_handle, $database);

    $email = mysqli_real_escape_string($db_handle, $_POST['Email']);
    $password = mysqli_real_escape_string($db_handle, $_POST['password']);

    if ($db_found) {
        // On vérifie si le client existe
        $sql = "SELECT * FROM client WHERE Email = '$email' AND Mot_de_passe = '$password'";
        $result = mysqli_query($db_handle, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['userType'] = 'Client';
            $_SESSION['Email'] = $email;
            header("Location: inscription_reussie.html");
            exit();
        } else {
            header("Location: inscription_impossible.html");
        }
    } 
    else {
        header("Location: inscription_impossible.html");
    }
    mysqli_close($db_handle);


}
?>