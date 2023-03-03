<?php 
include('./head.php') ;
session_start();
include('./functions.php');




//***************************************************************** */
// création d'une clé 'panier' ds $__SESSION si aucun panier n'est déjà créé

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}

//****************************************************************** */
// si j'accède au panier via le bouton 'ajouter au panier' :  (on fait ce if pr éviter une erreur qd on clic sur 'panieer' ds la navbar, cme ça il ne s'attend pas à un ajout d'article...)

if (isset($_GET['idArticle'])) {                // si on transmet un input qui porte le name 'idArticle'

    // récupérer l'article avec toutes ses infos en f(x) de l'id
    $article = getArticleFromId($_GET['idArticle']);


    // on l'ajoute au panier avec la f(x) addToCart 
    addToCart($article) ;
}

//********************************************************************* */










?> 





<body>
<?php include('./header.php') ?>

<main>
    <h1>Bienvenue dans ma boutique V1 WOULAH </h1>
</main>











<?php include ('./footer.php')?>
</body>
</html>