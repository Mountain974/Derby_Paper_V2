<?php
include('./head.php');
session_start();
include('./functions.php');

// vérification qu'un panier est présent ou non
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [] ;          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
}

//****************************************************************** */
// si j'accède à cette page via le bouton d'inscription :  (on fait ce if pr éviter une erreur qd on clic sur 'panier' ds la navbar, cme ça il ne s'attend pas à un ajout d'article...)

if (isset($_POST['nameUser'])) {            
    // je lance la f(x) pour ajouter la donnée ds la BDD
    createUser();
}?>
 
<body>
    <?php include('./header.php');  ?>

    <main class=" pb-5">
 
    <!-- Formulaire de connexion -->
    <div class="container-fluid w-50">
            <form action="./index.php" method="POST">

                <!-- Mail -->
                <div class="row">
                    <label for="emailUser" class="hidden-label">Email</label>
                    <input type="email" name="emailUser" class="form-control" id="emailUser" aria-describedby="email">
                    <div id="emailUser" class="form-text">Nous ne partagerons jamais votre email avec des tiers</div>
                </div>

                <!-- Mot de passe -->
                <div class="row">
                    <label for="passwordUser" class="hidden-label">Mot de passe</label>
                    <input type="password" name="passwordUser" class="form-control" id="passwordUser">
                </div>
                <!-- Bouton "Valider" -->
                <div>
                    <input class="button button-full m-auto" id="btn_ajout" type="submit" value="Valider">
                </div>

            </form>

            <!-- Bouton "Valider" -->
            <div class="container w-50 p-3">
                <h3 class="mb-3 text-center">Pas encore inscrit ?</h3>
                <div class="row justify-content-center">
                    <a href="./inscription.php"><button class="button button-full m-auto">Je crée mon compte</button></a>
                </div>
            </div>
    </div>



    </main>





    <?php include('./footer.php') ?>
</body>

</html>