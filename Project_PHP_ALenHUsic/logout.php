<?php
    // Initialize the session
    session_start();
    
    // Annule toutes les variables de session
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();
    
    // GO login page
    header("location: login.php");
    exit;
?>