<?php 
include('./head.php') ;
session_start();
include('./functions.php') ;

// vérification qu'un panier est présent ou non
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}
?> 

<body>
<?php include('./header.php') ?>

<main>
    <h1>Validation</h1>
</main>











<?php include ('./footer.php')?>
</body>
</html>