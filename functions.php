<?php
// -------------------RENVOI LA LISTE DES ARTICLES----------------------------
function getArticles(){
    return [
        [
            'id'                    => 1,
            'name'                  => 'Losc Paper' ,
            'price'                  => '100' , 
            'description'           => 'Réservé aux abonnés de Bollaert', 
            'detailed_description'  => 'Qualité premium, triple épaisseur pour les fins connaisseurs du football français',
            'image'                 => 'pq-losc.png',
        ],
        [
            'id'                    => 2,
            'name'                  => 'FC Nantes Paper' ,
            'price'                  => '80' , 
            'description'           => 'Pour les amoureux Bretons', 
            'detailed_description'  => 'Canari touch collection, simple mais efficace. Ce papier est un très bon rapport qualité-prix',
            'image'                 => 'pq-nantes.png',

        ],
        [
            'id'                    => 3,
            'name'                  => 'OM Paper' ,
            'price'                  => '80' , 
            'description'           => 'Pour les habitants de la ville lumière', 
            'detailed_description'  => 'Double épaisseur. Ce papier à fait ses preuves, il est notre Best-seller !',
            'image'                 => 'pq-om.png',
        ]
    ];
}

//************************************************************************ */
// récupérer l'article avec toutes ses infos en f(x) de l'id

function getArticleFromId($id){
    // récupère la liste des articles via getArticles et on la stocke dans une variable
    $articles = getArticles();

    //boucler sur la liste des articles 
    // dès que l'article comporte l'article en paramètre, on le renvoi

    foreach ($articles as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
}

//*************************************************************************** */
// on créé une f(x) qui nous permet d'ajouter un produit au panier 

function addToCart($articleToAdd){                                  // on parcours le panier
   
    // vérifier que l'article est présent dans le panier 
    for ($i=0 ; $i < count($_SESSION['panier']) ; $i++ ){           // tant que $i est inférieur au nbe d'articles ds le panier

        
        if ($_SESSION['panier'][$i]['id'] == $articleToAdd['id']){             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            $_SESSION['panier'][$i]['quantite'] += 1 ;   
            echo "<script> alert('Article ajouté !');</script>" ;   // si c'est la cas, quantité + 1
            return;                                                 // fait sortir de la f(x) entière ! 
        }                  
    }
    

    // si pas  présent : 

    $articleToAdd['quantite'] = 1 ;                           // augmente la quantité 
    array_push($_SESSION['panier'], $articleToAdd);      // ajoute au tableau $_SESSION [panier] l'article qu'on veut ajouter
    echo "<script> alert('Article ajouté !');</script>" ;

}


//******************************************************************************** */
// Fonction qui affiche les articles dans la page panier
function showArticles(){
    foreach ($_SESSION['panier'] as $article){?>
         
    <div class="card mb-3 mx-auto mt-3" style="max-width: 740px;">
    <div class="row">
      <div class="col-md-4 d-flex align-items-center">
      <img src="<?= "./images/" . $article['image'] ?>"  class="img-fluid rounded-start ps-3" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title fs-2 text-center border-bottom pb-2"><?= $article['name'] ?></h5>
          <p class="card-text border-bottom"><?= $article['description'] ?></p>
          <p class="card-text">Prix : <?= $article['price'] ?> €</p>
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
            <?php echo $article['price'] * $article['quantite']?> €
          </div>  
        </div>
      </div>
        
    </div>
  </div>
   <?php }
}

  //******************************************************************************** */
// Fonction qui actualise la quantité des articles ds le panier qd on modifie cette quantité via le form ds panier.php
function changeQuantity($id , $newQuantity) {
    for ($i=0 ; $i < count($_SESSION['panier']) ; $i++ ){           // tant que $i est inférieur au nbe d'articles ds le panier
    
        if ($_SESSION['panier'][$i]['id'] == $id){             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            $_SESSION['panier'][$i]['quantite'] = $newQuantity ;   
            echo "<script> alert('Quantité modifiée !');</script>" ;   // si c'est la cas, on met la nvlle quantité
            return;                                                 // fait sortir de la f(x) entière ! 
        }                  
    }
}

 //******************************************************************************** */
// Fonction pour supprimer un article depuis la page panier

function removeToCart($id) {
    for ($i=0 ; $i < count($_SESSION['panier']) ; $i++ ){           // tant que $i est inférieur au nbe d'articles ds le panier
        if ($_SESSION['panier'][$i]['id'] == $id){             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            array_splice($_SESSION['panier'] , $i, 1) == $_POST['idArticleDelete'] ;   
            echo "<script> alert('Article supprimé !');</script>" ;   // si c'est la cas, on met la nvlle quantité
            return;                                                 // fait sortir de la f(x) entière ! 
        }                  
    }
}


 //******************************************************************************** */
// Fonction pour calculer le total 

function totalPriceArticle() {
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $article['price'];
    }
    return $total;
}

 //******************************************************************************** */
// Fonction pour supprimer le panier 

function deleteToCart() {
            $_SESSION['panier'] = [];
            echo "<script> alert('Votre panier est vide !');</script>" ;  
        }                  
?>