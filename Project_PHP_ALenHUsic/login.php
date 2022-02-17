<?php
// Initialize the session
session_start();
 
// Vérifie si l'utilisateur est déjà connecté, si oui redirige-le vers la page d'accueil
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
//Définit les variables et initialise avec des valeurs vides
$username = "";
$password = "";

$username_err = "";
$password_err = "";
$login_err = "";
 
// Procede quande on click sur  submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Check si username es vide affiche le message error
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Veuillez entrer le nom d'utilisateur.";
    } 
    else
    {   // Set parameters
        $username = trim($_POST["username"]);
    }
    
    // Check si  password is es vide affiche le message error
    if(empty(trim($_POST["password"])))
    {
        $password_err = "S'il vous plait entrez votre mot de passe.";
    } 
    else
    {   // Set parameters
        $password = trim($_POST["password"]);
    }
    
   
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Vérifiez si le nom d'utilisateur existe, si oui, vérifiez le mot de passe
                if(mysqli_stmt_num_rows($stmt) == 1)
                { 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                           // Le mot de passe est correct, alors démarrez une nouvelle session
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                          
                            // Rediriger l'utilisateur vers la page d'accueil
                            header("location: index.php");
                        }
                         else
                        {
                            // Login nest pas valide affiche massage de erreur
                            $login_err = "Invalid username or password.";
                        }
                    }
                } 
                else
                {
                    // Username ne  exist pas ,  affiche massage de erreur
                    $login_err = "Invalid username or password.";
                }
            }
             else
            {
                echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            // Close statement
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p> Vous n'avez pas de compte ? <a href="register.php"> S'inscrire maintenant</a>.</p>
        </form>
    </div>
</body>
</html>