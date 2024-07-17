<?php 
    session_start();
    
    require_once ('./vendor/autoload.php');
    require_once('views/header.php');
    require_once('controllers/controller.php');
   
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        require_once('views/main.php');
    }  
    else
    {
        require_once('views/login.php');
    }
    
    require_once('views/footer.php');

  
    
    
    
    
    