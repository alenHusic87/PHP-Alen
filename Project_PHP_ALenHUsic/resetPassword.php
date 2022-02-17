<?php
// Initialize the session
session_start();
 
// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = "";
$confirm_password = "";

$new_password_err = "";
$confirm_password_err = "";
 
// Procede quande on click sur  submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Validate new password
    if(empty(trim($_POST["new_password"])))
    {
        $new_password_err = "Veuillez entrer le nouveau mot de passe.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6)
    {
        $new_password_err = "Le mot de passe doit comporter au moins 6 caractères.";
    } else
    {
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Veuillez confirmer le mot de passe.";
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password))
        {
            $confirm_password_err = "Le mot de passe ne correspond pas";
        }
    }
        
   
    // Vérifier les erreurs de saisie avant de mettre à jour la base de données
    if(empty($new_password_err) && empty($confirm_password_err))
    {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Lie les variables à l'instruction préparée en tant que paramètres  
            // " S "  == combien de paramètres  qui est string 
            // " I "  == combien de paramètres  qui est int  
            // Ici on utilise seulment les string alors on met just  S  
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            
            if(mysqli_stmt_execute($stmt) )
            {
                // Mot de passe mis à jour avec succès. Détruire la session et rediriger vers la page de connexion
                session_destroy();
                header("location: login.php");
                exit();
            } 
            else
            {
                echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            // Close 
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap&subset=cyrillic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Réinitialiser le mot de passe</h2>
        <p>Veuillez remplir ce formulaire pour réinitialiser votre mot de passe.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="index.php">Annuler</a>
            </div>
        </form>
    </div>    
</body>
</html>