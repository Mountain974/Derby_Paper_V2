<?php
include('./head.php');
session_start();
include('./functions.php');

// vérification qu'un panier est présent ou non
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}




// récupérer l'article avec toutes ses infos en f(x) de l'id
// on fait appelle à la f(x) getArticleFromId et on lui met en paramètre le name idArticle (provient du bouton détails produit du form de l'index.php) avec la méthode GET qui renvoi sa value (à savoir l'id de l'article)
$article = getArticleFromId($_GET['idArticle']);

// afficher les iinfos de l'article récupérer


?>


<body>
    <?php include('./header.php'); ?>


    <main style="background-color: #FFF3FB">
        <h1  class="text-color:white ps-5 pt-3">Produits</h1>

        <div class="container pb-5">
            <div class="row">
                <div class="card col-md-7 offset-md-3">
                    <img src="<?= "./images/" . $article['image'] ?>" class="card-img-top mt-3 mb-3 w-75 mx-auto" alt="<?php $article['nom'] ?>">
                    <div class="card-body container w-50 border border-dark mb-4" style="background-color: #FFF3FB">
                        <h5 class="card-title"><?= $article['nom'] ?></h5>
                        <div class="card-text"><?= $article['description'] ?></div>
                        <p class="card-text"><?= $article['description_detaillee'] ?></p>
                        <p class="card-text"><?= $article['prix'] ?> €</p>

                        <form action="./panier.php" METHOD="GET">
                            <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                            <button class="btn btn-primary fw-bold  rounded-pill border border-pink" style="background-color:white ; color:pink" type="submit">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>











    <?php include('./footer.php') ?>
</body>

</html>