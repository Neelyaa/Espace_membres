<?php 
require 'inc/header.php';
require 'action/forgetAction.php';
?>

<!-- Mot de passe oublié -->

    <h1>Mot de passe oublié</h1>

    <div class="container">
    <form action="" method="POST">

        <div class="champ-form"> 
            <input type="email" name="email" class="form_in"/>
            <label for="email" class="form_lab">Email</label>
           </div>

        <input type="submit" name="valid" value="Ok" id="valid" class="valide">
     <a href="index.php" class="back"> <i class="fa-solid fa-reply"></i> Accueil</a>
    </form>
</div>