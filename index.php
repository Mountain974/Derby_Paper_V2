<?php
include('./head.php');
session_start();
include('./functions.php') ;

// si le panier n'existe pas, il faut le créer (si on le créer alors qu'il existe déjà, ça va écraser celui existant)
// $_SESSION existe déjà par défaut qd on fait un session_start
// isset vérifie si une variable existe et si elle est non nulle


if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}

?>


<body>
    <?php include('./header.php') ?>

    <main>
        <h1>Bienvenue dans ma boutique V1 WOULAH </h1>

        <?php $articles = getArticles(); ?> // je récupère la liste d'articles que je stocke ds une variable

        <div class="container">
            <div class="row">
                <?php foreach ($articles as $article) { ?>

                    <div class="card col-md-4">
                        <img src="<?= "./images/" . $article['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['name'] ?></h5>
                            <p class="card-text"><?= $article['description'] ?></p>
                            <p class="card-text"><?= $article['price'] ?></p>

                            <!-- bouton détails produits -->
                            <div class="card-body row">
                                <form action="./produit.php" METHOD="GET">
                                    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary" type="submit">Détails produit</button>
                                </form>
                                <!-- bouton panier -->
                                <form action="./panier.php" METHOD="GET">
                                    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary" type="submit">Ajouter au panier</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </main>











    <?php include('./footer.php') ?>
</body>

</html>