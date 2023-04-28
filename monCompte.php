<?php
include('./head.php');
session_start();
include('./functions.php');

// si le panier n'existe pas, il faut le créer (si on le créer alors qu'il existe déjà, ça va écraser celui existant)
// $_SESSION existe déjà par défaut qd on fait un session_start
// isset vérifie si une variable existe et si elle est non nulle


if (!isset($_SESSION['id'])) {
    echo "<script> alert('Veuillez vous connecter à partir de l'onglet connexion');</script>";
}

//***************************************************************
?>

<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>

    <main>
        <div class="container-fluid pb-3">
            <div class="row text-center">
                <img id="watchPhoto" src="images/watchturquoise.jpg" style="width: 100vw">
            </div>
        </div>

        <div class="container mt-3 text-center mb-5">
            <h3>Mon compte</h3>
        </div>

        <div class="container mt-3 p-5 text-center">

            <div class="row p-5 ">
                <div class="col-md-3">
                    <i class="fas fa-user fa-3x mb-3"></i>
                    <a href="changeInformations.php">
                        <button class="btn btn-dark">Modifier mes informations </button>
                    </a>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-key fa-3x mb-3"></i>
                    <a href="changePassword.php">
                        <button class="btn btn-dark">Modifier mon mot de passe</button>
                    </a>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-home fa-3x mb-3"></i>
                    <a href="changeAddress.php">
                        <button class="btn btn-dark">Modifier mon adresse</button>
                    </a>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                    <a href="orders.php">
                        <button class="btn btn-dark">Voir mes commandes</button>
                    </a>
                </div>
            </div>
            
        </div>

    </main>


    <?php include('./footer.php');
    ?>
</body>

</html>