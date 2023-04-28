<?php
include('./head.php');
session_start();
include('./functions.php');

// vérification qu'un panier est présent ou non
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];          // on créer la clé 'panier' ds $_SESSION qui sera un tableau qui pour le moemnt est vide
} ?>


<body>
    <?php include('./header.php'); ?>

    <main>
        <!-- <div class="container-fluid w-75">  
            <form action="./connexion.php" METHOD="POST">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="firstName" class="form-label">Prénom</label>
                        <input type="hidden" name="firstNameUser" value="" class="form-control" id="firstNameUser" placeholder="Jackie">
                        <label for="email" class="form-label">Email</label>
                        <input type="hidden" name="emailUser" value="" class="form-control" placeholder="name@example.com">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="hidden" name="nameUser" value="" class="form-control" placeholder="Dupont">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="hidden" name="passwordUser" value="" class="form-control"  placeholder="motdepasse">
                    </div>
                </div>
                <div class="row">
                <div class="col-12 mb-3">
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="hidden" name="adressUser" value="" class="form-control" placeholder="1 boulevard Bollaert-Delelis">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="postalCode" class="form-label">Code Postal</label>
                        <input type="hidden" name="postalCodeUser" value="" class="form-control" placeholder="62000">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="town" class="form-label">Ville</label>
                        <input type="hidden" name="townUser" value="" class="form-control" placeholder="Lens">
                    </div>
                </div>
            </form>
        </div> -->

        <!-- Formulaire de changement de mdp -->
        <div class="container-fluid w-50 mt-5 pt-5 mb-5 pb-5">
            <form action="./index.php" method="POST">

                <div class="row">
                    <!-- Ancien mot de passe -->
                    <div class="col-6 mb-3">
                        <label for="oldPassword" class="hidden-label">Ancien mot de passe</label>
                        <input type="password" name="oldPassword" class="form-control" aria-describedby="oldPassword">
                    </div>

                <div class="row">
                    <!-- Nouveau mdp -->
                    <div class="col-6 mb-3">
                        <label for="newPassword" class="hidden-label">Nouveau mot de passe</label>
                        <input type="password" name="newPassword" class="form-control" aria-describedby="newPassword">
                    </div>
                </div>

                <!-- Bouton "Valider" -->
                <div>
                    <input class="button button-full m-auto" id="btn_ajout" type="submit" value="Valider">
                </div>
            </form>
        </div>
    </main>













    <?php include('./footer.php') ?>
</body>

</html>