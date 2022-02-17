<?php
// Include config file
require_once "config.php";
 
//Définit les variables et initialise avec des valeurs vides
$username =  "";
$password =""; 
$confirm_password = "";
$last_name = "";
$first_name = "";
$email = "";

//variables de Errror
$username_err = "";
$password_err = "";
$confirm_password_err = "";
$last_name_err = "";
$first_name_err = "";
$email_err = "";



// Procede quande on click sur  submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Veuillez saisir un nom d'utilisateur.";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        $username_err = " Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et des traits de soulignement.";
    } 
    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
           
            // Lie les variables à l'instruction préparée en tant que paramètres  
            // " S "  == combien de paramètres  qui est string 
            // " I "  == combien de paramètres  qui est int  
            // Ici on utilise seulment les string alors on met just  S   
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters username
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt))
            {
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "Ce nom d'utilisateur est déjà pris.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
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


    // Validate email 
    // Seter parameters  email
    if (empty($_POST["email"])) 
    {
        $email_err = "Veuillez saisir un e-mail.";
    }
    else 
    {
        $email = trim($_POST["email"]);
        // vérifie si l'adresse e-mail est aux bon format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          $email_err = " Format d'email invalide";
        }
    }


   // Validate firstname 
   // Seter parameters  firstname
   if(empty(trim($_POST["firstname"])))
   {
      $first_name_err = "Veuillez saisir un Prénom";     
   }
   else
    {
      $first_name = trim($_POST["firstname"]);
    }

    // Validate lastName
     // Seter parameters  lastName
    if(empty(trim($_POST["lastname"])))
    {
        $last_name_err = "Veuillez entrer un Nom de famille. .";     
    }
     else
    {
        $last_name = trim($_POST["lastname"]);
        
    }

    
    // Validate password
    // Seter parameters  password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Veuillez entrer un mot de passe.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = " Le mot de passe doit comporter au moins 6 caractères.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    // Seter parameters  confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Veuillez confirmer le mot de passe. ";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = " Le mot de passe n'est pas le même";
        }
    }
    
    
    // Vérifier les erreurs de saisie avant d'insérer dans la base de données
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err ) && empty($last_name_err )  && empty($first_name_err )  && empty($email_err ) )
    {
        
        // Prepare an insert statement
        $sql = " INSERT INTO users(username,fname,lname,email,password )  values(?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_first_name ,$param_last_name,$param_email ,$param_password);
            
            // Set parameters
            $param_username = $username;
            $param_last_name =$last_name;
            $param_first_name =$first_name;
            $param_email=$email;

            // Creates a password hash
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
  
            if(mysqli_stmt_execute($stmt))
            {
                // Rediriger vers la page de connexion
                header("location: login.php");
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
    <title>Sign Up</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>S'inscrire</h2>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="firstname" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
            </div> 
            <div class="form-group"> 
                <label>Nom de famille</label>
                <input type="text" name="lastname" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
            </div>  
            <div class="form-group">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Vous avez déjà un compte? <a href="login.php">Connectez-vous ici</a>.</p>
        </form>
    </div>    
</body>
</html>