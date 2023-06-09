<header>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="background-image: url(./images/pelouse-foot.jpg);
    background-size: cover;">
    <img src="./images/ballon.png">
    <a class="navbar-brand fs-1 ms-4" href="./index.php" style="color:white ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">DERBY PAPER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto gap-3">
        <li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
          <a class="nav-link active fs-3 px-3" aria-current="page" href="./index.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Accueil</a>
        </li>
        <li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
          <a class="nav-link active fs-3 px-3" aria-current="page" href="./gammes.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Nos Gammes</a>
        </li>
        <li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
          <a class="nav-link fs-3 px-3" href="./panier.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Panier</a>
        </li>

        <!-- Si je ne suis pas connecté, j'affiche comme cela ma navabar :  -->
        <?php if (!isset($_SESSION['id'])) {
        
          ?><li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
            <a class="nav-link fs-3 px-3" href="./inscription.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Inscription</a>
          </li>
          <li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
            <a class="nav-link fs-3 px-3" href="./connexion.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Connexion</a>
          </li>
        </ul>
      <?php } 
      // Sinon, si je suis connecté, je l'affiche comme cela : 
      else {?>
        <li class="nav-item rounded-pill" style="background-color:white; border: 3px solid #467A45">
          <a class="nav-link fs-3 px-3" href="./monCompte.php" style="color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Mon compte</a>
        </li>
        
        <form action="./index.php" method="POST">
          <li class="nav-item rounded-pill" style="background-color:white">
            <button class="nav-item rounded-pill fs-3 px-3 nav-link" name="deconnexion"  href="./index.php" style="background-color:white; border: 3px solid #467A45 ;color:#467A45 ; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Exit</button>
          </li>
        </form>
      </ul> 
      <?php } ?>
    </div>
  </div>
</nav>
</header>
