<?php
session_start();

$database = "immobilier";
$db_handle = mysqli_connect('localhost', 'root', 'On23wm!+t');
$db_found = mysqli_select_db($db_handle, $database);

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'Client') {
    header("Location: connexion.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carte_type = $_POST['carte_type'];
    $numero_carte = $_POST['numero_carte'];
    $nom_carte = $_POST['nom_carte'];
    $date_expiration = $_POST['date_expiration'];
    $code_securite = $_POST['code_securite'];
    $num_propriété = $_POST['num_prop'];

    if ($db_found) {
        $email = $_SESSION['Email'];
        $sql_client_id = "SELECT ID_Client FROM client WHERE Email = '$email'";
        $result_client_id = mysqli_query($db_handle, $sql_client_id);
        $client_id_row = mysqli_fetch_assoc($result_client_id);
        $client_id = $client_id_row['ID_Client'];

        $sql_solde = "SELECT Solde FROM paiement WHERE ID_Client = '$client_id'";
        $result_solde = mysqli_query($db_handle, $sql_solde);
        $solde_row = mysqli_fetch_assoc($result_solde);
        $solde = $solde_row['Solde'];

        $sql_a_louer = "SELECT Montant FROM a_louer WHERE Num_Propriété = '$num_propriété'";
        $result_a_louer = mysqli_query($db_handle, $sql_a_louer);
        //on regarde de quel table provient la propriété
        if(mysqli_num_rows($result_a_louer) > 0) {
            $bien = "a_louer";
        } else {

            $sql_terrain = "SELECT Montant FROM terrain WHERE Num_Propriété = '$num_propriété'";
            $result_terrain = mysqli_query($db_handle, $sql_terrain);
            if(mysqli_num_rows($result_terrain) > 0) {
                $bien = "terrain";
            } else {

                $sql_i_commercial = "SELECT Montant FROM i_commercial WHERE Num_Propriété = '$num_propriété'";
                $result_i_commercial = mysqli_query($db_handle, $sql_i_commercial);
                if(mysqli_num_rows($result_i_commercial) > 0) {
                    $bien = "i_commercial";
                } else {

                    $sql_i_résidentiel = "SELECT Montant FROM i_résidentiel WHERE Num_Propriété = '$num_propriété'";
                    $result_i_résidentiel = mysqli_query($db_handle, $sql_i_residentiel);
                    if(mysqli_num_rows($result_i_résidentiel) > 0) {
                        $bien = "i_résidentiel";
                    } else {
                        header("Location: paiement_refuse.html");
                    }
                }
            }
        }

        $sql_bien = "SELECT Montant FROM $bien WHERE Num_Propriété = '$num_propriété'";
        $result_bien = mysqli_query($db_handle, $sql_bien);
        $bien_row = mysqli_fetch_assoc($result_bien);
        $montant_bien = $bien_row['Montant'];

        // Si le solde est suffisant, on effectue le paiement et on met à jour le solde
        if ($solde >= $montant_bien) {
            $nouveau_solde = $solde - $montant_bien;
            $sql_paiement = "UPDATE paiement SET Solde = '$nouveau_solde' WHERE ID_Client = '$client_id'";
            mysqli_query($db_handle, $sql_paiement);

            header("Location: paiement_accepte.html");
        } else {
            header("Location: paiement_refuse.html");
        }
    } else {
        echo "Erreur de connexion à la base de données.";
    }

    mysqli_close($db_handle);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <!-- Dernier CSS compilé et minifié -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Dernier JavaScript compilé -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007a7b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body style="font-family: 'Playfair Display'; font-size: 17px;">
    <div class="container-fluid">

        <div style="text-align: center; background-color: white; padding: 20px; border-bottom: 1px solid #007a7b;">
            <div class="logo">
                <img src="logo.png" alt="logo" style="height: 100px;">
            </div>
            <div style="color: #007a7b; font-size: 40px; font-weight: bold; margin-top: 10px;">OMNES Immobilier</div>
        </div>

        <nav style="background-color: #007a7b; padding: 10px 0;">
            <ul style="list-style: none; display: flex; justify-content: center; margin: 0; padding: 0;">
                <li style="margin: 0 15px;"><a href="accueil.html" style="color: white; text-decoration: none; font-size: 18px;">Accueil</a></li>
                <li style="margin: 0 15px;"><a href="parcourir.html" style="color: white; text-decoration: none; font-size: 18px;">Tout Parcourir</a></li>
                <li style="margin: 0 15px;"><a href="rechercher.html" style="color: white; text-decoration: none; font-size: 18px;">Rechercher</a></li>
                <li style="margin: 0 15px;"><a href="rendezvous.php" style="color: white; text-decoration: none; font-size: 18px;">Rendez-vous</a></li>
                <li style="margin: 0 15px;"><a href="moncompte.php" style="color: white; text-decoration: none; font-size: 18px;">Mon Compte</a></li>
            </ul>
        </nav>

        <h1>Paiement</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="num_prop">Numéro de propriété :</label>
            <input type="text" id="num_prop" name="num_prop" required>
            <br>
            <label for="carte_type">Type de carte de paiement :</label>
            <select id="carte_type" name="carte_type" required>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="American Express">American Express</option>
                <option value="PayPal">PayPal</option>
            </select>
            <br>
            <label for="numero_carte">Numéro de la carte :</label>
            <input type="text" id="numero_carte" name="numero_carte" required>
            <br>
            <label for="nom_carte">Nom affiché dans la carte :</label>
            <input type="text" id="nom_carte" name="nom_carte" required>
            <br>
            <label for="date_expiration">Date d'expiration de la carte :</label>
            <input type="text" id="date_expiration" name="date_expiration" placeholder="AAAA-MM-DD" required>
            <br>
            <label for="code_securite">Code de sécurité :</label>
            <input type="text" id="code_securite" name="code_securite" required>
            <br>
            <button type="submit">Payer</button>
        </form>

        <br>
        <br>

        <div style="background-color: #007a7b; padding: 20px; margin: 0; width: 100%; color: white;">
            <div class="container">
                <div style="display: flex; justify-content: center; align-items: center; padding: 20px 0;">
                    <img src="logoB.png" class="media-object" width="150" height="100">
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <b><h6 class="text-uppercase font-weight-bold">Informations additionnelles</h6></b>
                        <ul>
                            <li><p>Toutes tentatives de copies de ce site et de fraude en notre nom sera sanctionné de 70 000 euros d'amendes, en application de l'article 41.39,2 du Code de la propriété  Intellectuelle.</p></li>
                            <li><p>Toutes vos données sont protégées en accord avec le RGPD.</p></li>
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
    </div>
</body>
</html>

