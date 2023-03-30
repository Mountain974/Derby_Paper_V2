
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

//******************************************************************
// Pour supprimer le panier 

if (isset($_POST['finish'])) {
    deleteToCart();
}
?>


<body>
    <?php include('./header.php') ?>

    <main class=" pb-5">
        <div class=" text-center mt-4 fs-5 d-flex justify-content-center gap-2" style ="color:#467A45">
            <img src="./images/flamme.png">
            <h1 class="fw-bold">Only fans </h1>
            <img src="./images/flamme.png">
        </div>

        <!-- <?php $articles = getArticles(); ?> // je récupère la liste d'articles que je stocke ds une variable -->

        <div class="container">
            <div class="row">
                <?php foreach ($articles as $article) { ?>

                    <div class="card col-md-4 mt-5">
                        <img src="<?= "./images/" . $article['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body" style="background-color: #467A45">
                            <h5 class="card-title fw-bold fs-3"><?= $article['name'] ?></h5>
                            <p class="card-text" style="color: #FFF"><?= $article['description'] ?></p>
                            <p class="card-text fw-bold">Prix : <?= $article['price'] ?> €</p>

<!-- // la value d'un form est transmise via une méthode GET, on l'appelle dans la nouvelle page en récupérer le 'name' de l'input du form -->


                            <!-- bouton détails produits -->
                            <div class="card-body row bg-dark gap-2">
                                <form action="./produit.php" METHOD="GET">
                                    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary rounded-pill border border-white fs-5" style="background-color:white ; color:#467A45 " type="submit">Détails produit</button>
                                </form>
                                <!-- bouton panier -->
                                <form action="./panier.php" METHOD="GET">
                                    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary rounded-pill border border-white fs-4" style="background-color:white ; color:#467A45" type="submit">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </main>

    <?php include('./footer.php');
     ?>
</body>

</html>