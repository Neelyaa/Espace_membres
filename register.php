<?php 
require 'inc/header.php';
require 'action/registerAction.php'; 
?>

<!-- Formulaire d'inscription  -->
<h1 class="title">Inscription</h1>


<?php if (!empty($erreur)) : ?>
    <div class="showerror">
        <p>Vous n'avez pas rempli le formulaire correctement !</p>
        <ul>
            <?php foreach ($erreur as $erreur) : ?>
                <li class="error"><i class="fa-solid fa-triangle-exclamation"></i><?= $erreur; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
<form method="POST" action="#">

    <div class="champ-form">   
        <input type="text" name="pseudo" id="pseudo" class="form_in">
        <label for="pseudo" class="form_lab">Pseudo : </label>
     
    </div>

    <div class="champ-form"> 
        <input type="text" name="email" class="form_in"/>
        <label for="email" class="form_lab">Email : </label>
       
    </div>

    <div class="champ-form">   
        <input type="password" name="mdp" id="mdp" class="form_in">
        <label for="mdp" class="form_lab">Mot de passe : </label>
     
    </div>

    <div class="champ-form"> 
        <input type="password" name="mdp2" id="mdp2" class="form_in">
        <label for="mdp2" class="form_lab">Confirmez le mot de passe : </label>
        </div>

   
    <input type="submit" name="valid" value="Inscription" id="valid" class="valide">

</form>
</div>
<div class="sign">
   <p>Déjà membre ? <a href="login.php">Connexion.</a></p> 
</div>
<?php  require 'inc/footer.php';?>