<?php
require 'inc/header.php';
require 'action/resetAction.php';
?>

<!-- Page reinitialisation mot de passe oublié -->

    <h1>Réinitialiser mon mot de passe</h1>


    <div class="container">
    <form action="" method="POST">

        <div class="champ-form">   
            <input type="password" name="mdp" class="form_in"/>
            <label for="mdp" class="form_lab">Mot de passe</label>
         </div>

        <div class="champ-form">
            <input type="password" name="mdp2" class="form_in"/>
            <label for="mdp2" class="form_lab">Confirmation du mot de passe</label>
            </div>

            <input type="submit" name="valid" value="Ok" id="valid" class="valide">

    </form>
</div>