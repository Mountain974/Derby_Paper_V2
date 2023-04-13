<?php
include('./head.php');
session_start();
include('./functions.php');

// si le panier n'existe pas, il faut le créer (si on le créer alors qu'il existe déjà, ça va écraser celui existant)
// $_SESSION existe déjà par défaut qd on fait un session_start
// isset vérifie si une variable existe et si elle est non nulle


if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}

//******************************************************************
// Pour supprimer le panier 

if (isset($_POST['finish'])) {
    deleteToCart();
}

//****************************************************************** */
// si j'accède à cette page via la page connexion: 

if (isset($_POST['emailUser'])) {            
    // je lance la f(x) pour ajouter la donnée ds la BDD
    connexionUser();
}?>













?>


<body>
    <?php include('./header.php') ?>
    <main class=" pb-5">
        <div class=" text-center mt-4 fs-5 d-flex justify-content-center gap-2" style="color:#467A45">
            <img src="./images/flamme.png">
            <h1 class="fw-bold">Only fans </h1>
            <img src="./images/flamme.png">
        </div>
        <!-- On récupère les articles et on les affiches  -->
        <div class="container">
            <div class="row">
                <?php $articles = getArticles(); // je récupère la liste d'articles que je stocke ds une variable
                showArticles($articles)
                ?>
            </div>
        </div>


    </main>

    <?php include('./footer.php');
    ?>
</body>

</html>