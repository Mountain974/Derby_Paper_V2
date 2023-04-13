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

        <!-- Formulaire d'inscription -->
        <div class="container-fluid w-50">
            <form action="./connexion.php" method="POST">

                <div class="row">
                    <!-- Prénom -->
                    <div class="col-6 mb-3">
                        <label for="firstNameUser" class="hidden-label">Prénom</label>
                        <input type="text" name="firstNameUser" class="form-control" id="firstNameUser" aria-describedby="firstNameUser">
                    </div>
                    <!-- Nom -->
                    <div class="col-6 mb-3">
                        <label for="nameUser" class="hidden-label">Nom</label>
                        <input type="text" name="nameUser" class="form-control" id="nameUser" aria-describedby="nameUser">
                    </div>
                </div>

                <div class="row">
                    <!-- Mail -->
                    <div class="col-6 mb-3">
                        <label for="emailUser" class="hidden-label">Email</label>
                        <input type="email" name="emailUser" class="form-control" id="emailUser" aria-describedby="email">
                    </div>
                    <!-- Mot de passe -->
                    <div class="col-6 mb-3">
                        <label for="passwordUser" class="hidden-label">Mot de passe</label>
                        <input type="password" name="passwordUser" class="form-control" id="passwordUser">
                    </div>
                </div>
                <!-- Adresse -->
                <div class="mb-3">
                    <label for="adressUser" class="hidden-label">Adresse</label>
                    <input type="text" name="adressUser" class="form-control" id="adressUser" aria-describedby="adresse">
                </div>

                <div class="row">
                    <!-- Code postal -->
                    <div class="col-6 mb-3">
                        <label for="postalCodeUser" class="hidden-label">Code postal</label>
                        <input type="text" name="postalCodeUser" class="form-control" id="postalCodeUser" aria-describedby="CodePostal">
                    </div>
                    <!-- Ville -->
                    <div class="col-6 mb-3">
                        <label for="townUser" class="hidden-label">Ville</label>
                        <input type="text" name="townUser" class="form-control" id="townUser" aria-describedby="ville">
                    </div>
                </div>

                <!-- Case à cocher : "Se souvenir de moi" -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
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