<?php

// -------------------RENVOI LA LISTE DES ARTICLES----------------------------
function getArticles(){
    return [
        [
            'id'                    => 1,
            'name'                  => 'rcl' ,
            'price'                  => '100' , 
            'description'           => 'un super club', 
            'detailed_description'  => 'le plus beau de la ligue 1 depuis 1901',
            'image'                 => 'watch1.jpg'
        ],
        [
            'id'                    => 2,
            'name'                  => 'FC Nantes' ,
            'price'                  => '80' , 
            'description'           => 'un club de ferveur', 
            'detailed_description'  => 'la canari touch',
            'image'                 => 'watch2.jpg'

        ],
        [
            'id'                    => 3,
            'name'                  => 'OL' ,
            'price'                  => '80' , 
            'description'           => 'Le lyon des Alpes', 
            'detailed_description'  => '2001, non non non ',
            'image'                 => 'watch3.jpg'
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
    foreach ($_SESSION['panier'] as $articleCart){

        if ($articleCart['id'] == $articleToAdd['id']){             // on vérifie que l'id de l'article du panier correspond à l'id de l'artcile qu'on veut ajouter, donc si il est présent
            $articleCart['quantite'] += 1 ;   
            echo "<script> alert('Article ajouté !');</script>" ;   // si c'est la cas, quantité + 1
            return;                                                 // fait sortir de la f(x) entière ! 
        }                  
    }


    // si pas  présent : 

    $article['quantite'] = 1 ;                           // augmente la quantité 
    array_push($_SESSION['panier'], $articleToAdd);      // ajoute au tableau $_SESSION [panier] l'article qu'on veut ajouter
    echo "<script> alert('Article ajouté !');</script>" ;

}


//******************************************************************************** */















?>