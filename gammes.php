<?php
include('./head.php');
session_start();
include('./functions.php');

// vérification qu'un panier est présent ou non
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}?>

 
<body>
    <?php include('./header.php'); ?>

    <main class=" pb-5">
        <div class=" text-center mt-4 fs-5 d-flex justify-content-center gap-2" style="color:#467A45">
            <h1 class="fw-bold">Nos Gammes</h1>
        </div>
        
        <?php $gammes = getGammes();

            foreach ($gammes as $gamme) { ?>
                <!-- On récupère le nom de la gamme -->
                <h1 class="text-center mt-5 border-dark"><?php echo $gamme['nom'] ?> </h1>
                
                <div class="row d-flex justify-content-center">
                    <?php $articlesgamme = getArticlesByGamme($gamme['id']) ; 
                          showArticles($articlesgamme)?>
                </div>
            <?php } ?>


    </main>



    <?php include('./footer.php') ?>
</body>

</html>