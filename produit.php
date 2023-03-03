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



    <main>
        <h1>Produits</h1>

        <div class="container">
            <div class="row">
                <div class="card col-md-7 offset-md-3">
                    <img src="<?= "./images/" . $article['image'] ?>" class="card-img-top" alt="<?php $article['name'] ?>">
                    <div class="card-body container w-50 border border-dark bg-light mb-4">
                        <h5 class="card-title"><?= $article['name'] ?></h5>
                        <p class="card-text"><?= $article['description'] ?></p>
                        <p class="card-text"><?= $article['price'] ?> €</p>

                        <form action="./panier.php" METHOD="GET">
                            <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                            <button class="btn btn-primary" type="submit">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>











    <?php include('./footer.php') ?>
</body>

</html>