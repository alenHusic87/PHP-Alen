
<?php
// Initialize the session
session_start();
 
// Vérifie si l'utilisateur est déjà connecté, si oui redirige-le vers la page d'accueil
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Responsive-Web</title>
        <link rel="stylesheet" href="styles/style.css?v=2">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap&subset=cyrillic">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    </head>


    
    
<body>
    <header>
        <div class="icon_left"> 
            <img  src="svg/menu.svg" alt="Hambuger menu">
            <img class="logo_bsystem" src="svg/logo-noir.svg" alt="Logo B_System">
        </div>
        <div class="buttons_right">
             <div class="acces">
                <a href=""><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></a>
                <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.65681 9.6989H8.72041H8.74426H8.78401C9.94873 9.68026 10.8908 9.29633 11.5865 8.56202C13.1169 6.94429 12.8625 4.17105 12.8347 3.9064C12.7353 1.91965 11.7336 0.969145 10.9067 0.525575C10.2906 0.193829 9.57109 0.0149099 8.76811 0H8.74029H8.72439H8.70053C8.25929 0 7.39271 0.0670947 6.5619 0.510665C5.72712 0.954235 4.70948 1.90474 4.6101 3.9064C4.58227 4.17105 4.32786 6.94429 5.8583 8.56202C6.54998 9.29633 7.49209 9.68026 8.65681 9.6989ZM5.67386 3.98171L5.67386 3.9817C5.67475 3.97719 5.67555 3.97308 5.67555 3.96973C5.80673 1.29713 7.83008 1.01011 8.69667 1.01011H8.71257H8.74437C9.81766 1.03248 11.6423 1.4425 11.7655 3.96973C11.7655 3.98091 11.7655 3.9921 11.7695 3.99955C11.7734 4.02564 12.0517 6.56033 10.7876 7.89477C10.2867 8.42407 9.6189 8.68499 8.74039 8.69245H8.72052H8.70064C7.82611 8.68499 7.15431 8.42407 6.65741 7.89477C5.39729 6.56778 5.6676 4.02192 5.67157 3.99955C5.67157 3.9934 5.67278 3.98724 5.67386 3.98171ZM16.8895 14.2874V14.2986C16.8935 14.4924 16.8975 15.4877 16.6987 15.9834C16.659 16.0803 16.5835 16.1623 16.492 16.2182L16.4903 16.2192C16.3481 16.3038 13.4941 18 8.73253 18C3.95041 18 1.09228 16.2928 0.973023 16.2182C0.877619 16.1623 0.806066 16.0803 0.766315 15.9834C0.555632 15.4839 0.559607 14.4887 0.563582 14.2949V14.2837C0.567557 14.2539 0.567557 14.224 0.567557 14.1905L0.56774 14.1849C0.591682 13.4474 0.647473 11.7289 2.3683 11.175L2.36833 11.175C2.38025 11.1712 2.39217 11.1675 2.40805 11.1638C4.2088 10.7351 5.69153 9.76597 5.70743 9.75479C5.94992 9.59451 6.28383 9.65042 6.45476 9.8778C6.62569 10.1052 6.56607 10.4183 6.32358 10.5786C6.32055 10.5804 6.31447 10.5842 6.30545 10.5899C6.11329 10.7114 4.5851 11.6772 2.69427 12.1329C1.76805 12.4423 1.6647 13.3704 1.63687 14.2203C1.63687 14.2376 1.63582 14.2539 1.6348 14.2697C1.63383 14.2846 1.6329 14.299 1.6329 14.3135C1.62495 14.649 1.65277 15.1671 1.71638 15.4653C2.36433 15.8082 4.90445 16.9973 8.72855 16.9973C12.5686 16.9973 15.0928 15.8119 15.7367 15.469C15.8004 15.1708 15.8242 14.6527 15.8202 14.3172C15.8163 14.2874 15.8163 14.2576 15.8163 14.224C15.7884 13.3742 15.6851 12.446 14.7589 12.1367C12.7792 11.6595 11.1971 10.627 11.1295 10.5823C10.8871 10.422 10.8274 10.1089 10.9984 9.88153C11.1693 9.65415 11.5032 9.59824 11.7457 9.75852C11.7616 9.7697 13.2523 10.7388 15.0451 11.1675C15.051 11.1694 15.058 11.1712 15.0649 11.1731C15.0719 11.175 15.0789 11.1768 15.0848 11.1787C16.8059 11.729 16.8615 13.448 16.8854 14.1889L16.8856 14.1942C16.8856 14.2115 16.8866 14.2278 16.8876 14.2436C16.8886 14.2585 16.8895 14.2729 16.8895 14.2874Z" fill="black"/>
                </svg>
            </div>
           

            <div class="acces">
                <a href="">Panier</a>
                
                <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7465 14.6633L15.75 4.14534C15.7293 3.91174 15.5258 3.73486 15.2879 3.73486H12.3319C12.3042 1.98026 10.8212 0.5625 8.99994 0.5625C7.17883 0.5625 5.69578 1.98026 5.66815 3.73486C5.66815 3.73486 2.95345 3.73486 2.71214 3.73486C2.47083 3.73486 2.27074 3.91174 2.25 4.14534L2.25336 14.6633C2.25336 14.6767 2.25 14.6901 2.25 14.7034C2.25 15.901 3.38477 16.875 4.78163 16.875H13.2182C14.6152 16.875 15.75 15.901 15.75 14.7034C15.75 14.6901 15.75 14.6767 15.7465 14.6633ZM8.99994 1.46328C10.3072 1.46328 11.3731 2.47739 11.4005 3.73486H6.59933C6.62697 2.47739 7.69267 1.46328 8.99994 1.46328ZM13.2182 15.9744H4.78163C3.9055 15.9744 3.19515 15.4139 3.18136 14.7235V4.63905H5.66461V6.00664C5.66461 6.25684 5.8716 6.45699 6.13029 6.45699C6.38897 6.45699 6.59597 6.25684 6.59597 6.00664V4.63905H11.4005V6.00664C11.4005 6.25684 11.6075 6.45699 11.8662 6.45699C12.1249 6.45699 12.3319 6.25684 12.3319 6.00664V4.63905H14.7825V14.7235C14.7687 15.4139 14.091 15.9744 13.2182 15.9744Z" fill="black"/>
                </svg>
                <h2> </h2>
            </div>
            
        </div>
    </header>

   
        <div class="text_categorie">
            <h1>Catégorie de produits</h1>
        </div>

        <div class="accueil">
            <a class="home" href="">Accueil</a>
            <span class="fleche">></span>
            <a class="catego" href="">Catégorie de produits</a>
        </div>

        <div class="carte_proiduits">
            <div class="carte_proiduit">
                <img class="zoomA" src="img/img_1.png" alt="Photo 1">
                <h1>Produit #1</h1>
                <p>$ 60.99</p>
                <span></span>
                <button>Add-cart</button>
            </div>
            <div class="carte_proiduit">
                <img src="img/img_2.png" alt="Photo 2">
                <h1>Produit #2</h1>
                <p>$ 60.99</p>
                <span></span>
                <button>Add-cart</button>
            </div>
            <div class="carte_proiduit">
                <img src="img/img_3.png" alt="Photo 3">
                <h1>Produit #3</h1>
                <p>$ 60.99</p>
                <span></span>
                <button>Add-cart</button>
            </div>
            <div class="carte_proiduit">
                <img src="img/img_4.png" alt="Photo 4">
                <h1>Produit #4</h1>
                <p>$ 60.99</p>
                <span></span>
                <button>Add-cart</button>
            </div>
            <div class="carte_proiduit">
                <img  src="img/img_5.png" alt="Photo 5">
                <h1>Produit #5</h1>
                <p>$ 60.99</p>
                <button>Add-cart</button>
            </div>
            <div class="carte_proiduit">
                <img  src="img/img_6.png" alt="Photo 6">
                <h1>Produit #6</h1>
                <p>$ 60.99</p>
                <button>Add-cart</button>
            </div>
        </div>

        <div class="moreproduits">
            <button>Voir plus de produits</button>
        </div>

        <footer class="containaire_footer_icons">
            <div> 
              <a href="https://www.behance.net/"><i class="fab fa-behance" ></i></a>
              <a href="https://www.youtube.com/"><i class="fab fa-youtube" ></i></a>
              <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p" ></i></a>
              <a href="https://twitter.com/"><i class="fab fa-twitter" ></i></a>
              <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in" ></i></a>
              <a href="logout.php">  <img  src="img/singout.png" >  </a>
            </div>
        </footer>
       

        <div class="logo_bsystem_end"> 
            <img  src="svg/logo-noir.svg" alt="Logo B_System">
        </div>

        <div class="restart_pasword"> 
            <a href="resetPassword.php">  RestartPasword  </a>
        </div>
       
            
       

        

        <div class="test">
             <p>Organic Design System &copy; 2019 B_system. All rights reserved example. Customer Service:010 210 465 </p> 
       </div>
       <div class="select"></div>

       <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
