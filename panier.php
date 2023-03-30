<?php
include('./head.php');
session_start();
include('./functions.php');

//***************************************************************** */
// création d'une clé 'panier' ds $__SESSION si aucun panier n'est déjà créé

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}

//****************************************************************** */
// si j'accède au panier via le bouton 'ajouter au panier' :  (on fait ce if pr éviter une erreur qd on clic sur 'panier' ds la navbar, cme ça il ne s'attend pas à un ajout d'article...)

if (isset($_GET['idArticle'])) {                // si on transmet un input qui porte le name 'idArticle'

    // récupérer l'article avec toutes ses infos en f(x) de l'id (on appelle l'id du form via son name ds index.php)
    $article = getArticleFromId($_GET['idArticle']);


    // on l'ajoute au panier avec la f(x) addToCart 
    addToCart($article);
}

//******************************************************************
// Pour vérifier si on a modifier la quantité d'un article via le form ds panier.php

if (isset($_POST['quantite'])) {
    changeQuantity($_POST['idArticleModifie'], $_POST['quantite']);
}

//******************************************************************
// Pour supprimer un article dans le panier 

if (isset($_POST['idArticleDelete'])) {
    removeToCart($_POST['idArticleDelete']);
}

//******************************************************************
// Pour vider le panier 

if (isset($_POST['emptyCart'])) {
    deleteToCart();
}?>

<!-- ******************************************************************
     ***************************   BODY    ****************************
     ****************************************************************** -->


<body>
    <?php include('./header.php') ?>

    <main class="pb-5" style="background-color: #FFF3FB">
        <h1 class="pt-4 pb-3 ms-5" style="color:#467A45">VOTRE PANIER</h1>

        <!-- ****************************************************************** -->
        <!-- Si mon panier n'est pas vide :  -->
        <?php
        if (count($_SESSION['panier']) > 0) { ?>
            <!-- Fonction qui affiche les articles dans la page panier -->

            <?php showArticles(); ?>
            <div class="card-body text-center pt-3 pb-3 fw-bold border w-75 mx-auto"style="background-color: #FFF">TOTAL : <?php echo totalPriceArticle() ?> €


                <!-- Boutton de validation de commande -->
                <button type="button" class="btn btn-primary rounded-pill border border-pink fw-bold" style="background-color:white ; color:pink" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Valider ma commande
                </button>

                <!-- Boutton de vidage de panier -->
                <form METHOD="POST" action="./panier.php">
                    <input type="hidden" name="emptyCart" value="true">
                    <button class="btn btn-primary rounded-pill border border-white" style="background-color:pink" type="submit">Vider mon panier</button>
                </form>
            </div>
            <!-- Modal de validation -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Votre commande a été validée.</h1>
                            <button type="button" class="btn-close  rounded-pill border border-pink" style="background-color:white ; color:pink" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">Sous total HT : <?php echo totalPriceArticle() ?> €</div>
                                <div class="row">Sous total TTC : <?php echo ((totalPriceArticle()) + (totalPriceArticle() / 100) * 20) ?> €</div>
                                <div class="row">Frais de port : <?php echo ((totalPriceArticle() / 100) * 10) ?> €</div>
                                <div class="row">Montant total TTC : <?php echo (((totalPriceArticle() / 100) * 10) + ((totalPriceArticle()) + (totalPriceArticle() / 100) * 20)) ?> €</div>
                                <div class="row">Enjoy !</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form METHOD="POST" action="./index.php">
                                <input type="hidden" name="finish" value="true">
                                <button class="btn btn-primary  rounded-pill border border-pink" style="background-color:white ; color:pink" type="submit">Retour à l'accueil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } 
        // Sinon, si mon panier est vide : 
        else { ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    
                    <div class="col-md-8">
                        <div class="card-body">
                            VOTRE PANIER EST VIDE
                        </div>
                        <div>
                            <a href="./index.php"><button class="btn btn-primary rounded-pill border border-pink" style="background-color:white ; color:pink" type="submit">Retour à l'accueil</button></a>
                        </div>
                    </div>

                </div>
            </div>
        <?php  }?>
 
    </main>

    <?php include('./footer.php') ?>
</body>

</html>