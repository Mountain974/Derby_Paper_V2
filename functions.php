<?php
// -------------------CONNECTION A LA BDD----------------------------
function getConnection()
{

    // try : je tente une connexion (fonctionne comme un if else) pour avoir accès à la BDD
    try {
        $db = new PDO(      // PDO : sorte de pluggin natif de PHP permettant de connecter le projet à la BDD ; new car c'est une nvle connection
            //new : pour créer une instance de la classe
            'mysql:host=localhost;dbname=boutique_php_v2;charset=utf8', //localhost car on est en local, mais on pourrait mettre le lien si en ligne
            'root',         // pseudo de l'utilisateur mySql
            '',             // mdp de l'utilisateur mySql
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) //options facultatives :  la 1e option : permet d'afficher les erreurs ; la 2e : évite les doublons pr un vardump plus lisible
        );
        // si la connexion ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $erreur) {   // Catch permet de récupérer l'erreur dans une variable qu'on lui met en paramètre (exception est un type comme int, float...)
        die('Erreur : ' . $erreur->getMessage());
    }
    // je retourne la connexion 
    return $db;
}

//************************************************************************ */
// -------------------RENVOI LA LISTE DES ARTICLES----------------------------
function getArticles()
{
    // je me connecte à la BDD
    $db = getConnection();

    // classe : c'est un fichier qui représente un élément du monde réel qui ne peux ê représenter par float, int... (ex: humain). elle se compose d'attribut et de méthodes
    //méthode : c'est une f(x) à l'intérieur d'une classe
    //ici, on créer l'instance (obj) $db dans la classe PDO
    // query : obligatoire pour faire une requête SQL, c'est une fonction de la classe PDO
    // -> cette flèche permet d'accéder à la f(x) (query) de la classe (PDO) d'un objet ($db) // (un peu comme comme une asso clé/valeur)

    //j'exécute ma requête qui va récupérer tous les articles 
    $results = $db->query('SELECT * FROM articles');

    //je récupère les résultats et je les renvoie grâce à un return
    return $results->fetchAll();      // on est obligé de faire un fetchAll avec un SELECT
}                                       // fetchAll récupère les résultat 

//************************************************************************ */
// -------------------AFFICHER L'ENSEMBLE DES ARTICLES----------------------------

function showArticles($articles)
{
    foreach ($articles as $article) { ?>

        <div class="card col-md-4 mt-5">
            <img src="<?= "./images/" . $article['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body" style="background-color: #467A45">
                <h5 class="card-title fw-bold fs-3"><?= $article['nom'] ?></h5>
                <p class="card-text" style="color: #FFF"><?= $article['description'] ?></p>
                <p class="card-text fw-bold">Prix : <?= $article['prix'] ?> €</p>

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
    <?php }
}

//************************************************************************ */
// -------------------Récupérer le nom des gammes et les affciher----------------------------

function getGammes()
{
    $db = getConnection();
    $gammes = $db->query('SELECT * FROM gammes');
    return $gammes->fetchAll();
}
// -------------------Récupérer le contenu des articles présents dans la gamme et les afficher----------------------------
// attention, ne jamais mettre de variable PHP dans une requête SQL --> on remplace le query par un prepare et ajoutons un execute
function getArticlesByGamme($idGamme)
{

    $db = getConnection();

    // on prépare la requête SQL (id_game est une variable SQL) 
    $query = $db->prepare("SELECT * FROM articles WHERE id_gamme = :id_gamme");

    // je lance ma requête en indiquant à quoi correspond ma variable sql
    $query->execute(['id_gamme' => $idGamme]);

    // fetchAll pour récupérer les résultats
    $result = $query->fetchAll();
    return $result;
}

//************************************************************************ */
// récupérer l'article avec toutes ses infos en f(x) de l'id

function getArticleFromId($id)
{
    $db = getConnection();
    $query = $db->prepare("SELECT * FROM articles WHERE id = ?");
    $query->execute([$id]);
    return $query->fetch(); //un seul résultat, dc pas fetchAll
}

//*************************************************************************** */
// on créé une f(x) qui nous permet d'ajouter un produit au panier 

function addToCart($articleToAdd)
{                                  // on parcours le panier

    // vérifier que l'article est présent dans le panier 
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {           // tant que $i est inférieur au nbe d'articles ds le panier


        if ($_SESSION['panier'][$i]['id'] == $articleToAdd['id']) {             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            $_SESSION['panier'][$i]['quantite'] += 1;
            echo "<script> alert('Article ajouté !');</script>";   // si c'est la cas, quantité + 1
            return;                                                 // fait sortir de la f(x) entière ! 
        }
    }


    // si pas  présent : 

    $articleToAdd['quantite'] = 1;                           // augmente la quantité 
    array_push($_SESSION['panier'], $articleToAdd);      // ajoute au tableau $_SESSION [panier] l'article qu'on veut ajouter
    echo "<script> alert('Article ajouté !');</script>";
}


//******************************************************************************** */
// Fonction qui affiche les articles dans la page panier
function showArticlesInCart()
{
    foreach ($_SESSION['panier'] as $article) { ?>

        <div class="card mb-3 mx-auto mt-3" style="max-width: 740px;">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <img src="<?= "./images/" . $article['image'] ?>" class="img-fluid rounded-start ps-3" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fs-2 text-center border-bottom pb-2"><?= $article['nom'] ?></h5>
                        <p class="card-text border-bottom"><?= $article['description'] ?></p>
                        <p class="card-text">Prix : <?= $article['prix'] ?> €</p>
                        <div class="row d-flex justify-self pb-2">
                            <p class="card-text">Quantité :</p>
                            <div class="col-9">
                                <form METHOD="POST" action="./panier.php" class="d-flex justify-content-between">
                                    <input type="number" name="quantite" value="<?= $article['quantite'] ?>" min="1" max="15">
                                    <input type="hidden" name="idArticleModifie" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary rounded-pill border border-pink" style="background-color:white ; color:pink" type="submit">Modifier la quantité</button>
                                </form>
                            </div>
                            <div class="col-3">
                                <form METHOD="POST" action="./panier.php">
                                    <input type="hidden" name="idArticleDelete" value="<?= $article['id'] ?>">
                                    <button class="btn btn-primary rounded-pill border border-white" style="background-color:pink" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </div>
                        <div>Sous total :
                            <?php echo $article['prix'] * $article['quantite'] ?> €
                        </div>
                    </div>
                </div>

            </div>
        </div>
<?php }
}

//******************************************************************************** */
// Fonction qui actualise la quantité des articles ds le panier qd on modifie cette quantité via le form ds panier.php
function changeQuantity($id, $newQuantity)
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {           // tant que $i est inférieur au nbe d'articles ds le panier

        if ($_SESSION['panier'][$i]['id'] == $id) {             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            $_SESSION['panier'][$i]['quantite'] = $newQuantity;
            echo "<script> alert('Quantité modifiée !');</script>";   // si c'est la cas, on met la nvlle quantité
            return;                                                 // fait sortir de la f(x) entière ! 
        }
    }
}

//******************************************************************************** */
// Fonction pour supprimer un article depuis la page panier

function removeToCart($id)
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {           // tant que $i est inférieur au nbe d'articles ds le panier
        if ($_SESSION['panier'][$i]['id'] == $id) {             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            array_splice($_SESSION['panier'], $i, 1) == $_POST['idArticleDelete'];
            echo "<script> alert('Article supprimé !');</script>";   // si c'est la cas, on met la nvlle quantité
            return;                                                 // fait sortir de la f(x) entière ! 
        }
    }
}


//******************************************************************************** */
// Fonction pour calculer le total 

function totalPriceArticle()
{
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $article['prix'];
    }
    return $total;
}

//******************************************************************************** */
// Fonction pour supprimer le panier 

function deleteToCart()
{
    $_SESSION['panier'] = [];
    echo "<script> alert('Votre panier est vide !');</script>";
}


//************************************************************************ */
// ******************************************* UTILISATEURS (INSCRIPTION ET CONNEXION) ****************************************************

// ***************** vérifier la présence de champs vides ************************

function checkEmptyFields()
{
    foreach ($_POST as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}


// ***************** vérifier la longueur des champs ************************

function checkInputsLenght()
{
    $inputsLenghtOk = true;

    if (strlen($_POST['firstNameUser']) > 25 || strlen($_POST['firstNameUser']) < 3) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['nameUser']) > 25 || strlen($_POST['nameUser']) < 3) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['emailUser']) > 40 || strlen($_POST['emailUser']) < 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['adressUser']) > 40 || strlen($_POST['adressUser']) < 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['postalCodeUser']) !== 5) {
        $inputsLenghtOk = false;
    }

    if (strlen($_POST['townUser']) > 25 || strlen($_POST['townUser']) < 3) {
        $inputsLenghtOk = false;
    }

    return $inputsLenghtOk;
}


// ***************** vérifier que le mot de passe réunit tous les critères demandés ************************

function checkPassword($passwordUser)
{
    // minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";
    return preg_match($regex, $passwordUser);
}


// ***************** vérifier que l'e-mail est déjà utilisé ************************

// function checkEmail($emailUser)
// {
//     $db = getConnection();

//     $query = $db->prepare("SELECT * FROM clients WHERE email = ?");
//     $user = $query->execute([$emailUser]);

//     if ($user) {
//         return true;
//     } else {
//         return false;
//     }
// }
// -------------------Récupérer les informations utilisateurs dans le formulaire d'inscription et les stocker en BDD----------------------------

function createUser()
{
    $db = getConnection();

    // $nameUser = $_POST["nameUser"];
    // $firstNameUser = $_POST["firstNameUser"];
    // $emailUser = $_POST["emailUser"];
    // $passwordUser = $_POST["passwordUser"];
    // $adressUser = $_POST["adressUser"];
    // $postalCodeUser = $_POST["postalCodeUser"];
    // $townUser = $_POST["townUser"];
    // $idUser = $db->query('SELECT * FROM clients WHERE id = :id');

    if (checkEmptyFields()) {  // vérif si champs vides => message d'erreur si c'est le cas
        echo "<div class=\"container w-50 text-center p-3 mt-2 bg-danger text-white\"> Attention : un ou plusieurs champs vides !</div>";
    } else {

        if (checkInputsLenght() == false) {  // vérif si longeur des champs correcte
            echo "<div class=\"container w-50 text-center p-3 mt-2 bg-danger text-white\"> Attention : longueur incorrecte d'un ou plusieurs champs !</div>";
        } else {

            // if (checkEmail($_POST['emailUser'])) {  vérif si email déjà utilisé
            //     echo "<div class=\"container w-50 text-center p-3 mt-2 bg-danger text-white\"> Attention : e-mail déjà utilisé !</div>";
            // } else {

            if (!checkPassword(strip_tags($_POST['passwordUser']))) { // vérif si mdp réunit les critères requis
                echo "<div class=\"container w-50 text-center p-3 mt-2 bg-danger text-white\"> Attention : sécurité du mot de passe insuffisante !</div>";
            } else {

                // hâchage du mot de passe
                echo '<script>alert(\longueur champs ok!\')</script>';
                $hashedPassword = password_hash(strip_tags($_POST['passwordUser']), PASSWORD_DEFAULT);

                // on prépare la requête SQL (id_game est une variable SQL) 
                $query = $db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");

                // je lance ma requête en indiquant à quoi correspond ma variable sql
                $query->execute(array(
                    'nom' =>  strip_tags($_POST['nameUser']),
                    'prenom' => strip_tags($_POST['firstNameUser']),
                    'email' =>  strip_tags($_POST['emailUser']),
                    'mot_de_passe' => $hashedPassword,
                ));

                // récupération de l'id de l'utilisateur créé
                $id = $db->lastInsertId();

                // insertion de son adresse dans la table adresses
                createAdress($id);

                // on renvoie un message de succès 
                echo '<script>alert(\'Le compte a bien été créé !\')</script>';
                
            }
        }
    }
}

function createAdress($id) {
    
    $db = getConnection();

    // on push les adresses ds la bdd à partir de l'id
    $query = $db->prepare("INSERT INTO adresses (id_client, adresse, code_postal, ville) VALUES (:id_client, :adresse, :code_postal, :ville)");

    $query->execute(array(
        'id_client' =>  strip_tags($id),
        'adresse' => strip_tags($_POST['adressUser']),
        'code_postal' =>  strip_tags($_POST['postalCodeUser']),
        'ville' => strip_tags($_POST['townUser']),
    ));
}

// ***************** fonction pr vérifier si l'utilisateur existe ds la bdd lors de sa connexion ************************

function connexionUser() {
    $db = getConnection();

   if( ($_POST['emailUser']=$db->query('SELECT * FROM clients WHERE email')) && ($_POST['passwordUser']=$db->query('SELECT * FROM clients WHERE mot_de_passe')) ){
    echo "Vous êtes connecté";
   }
   else{
    echo "Email ou Mot de passe incorrect(s).";
   }
}






?>