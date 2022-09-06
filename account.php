<?php
require 'inc/header.php';
require 'action/accountAction.php';
?>

<!-- Page modification mot de passe -->

<h1>Bonjour <?= $_SESSION['auth']->pseudo; ?></h1>

<div class="container">
<form action="" method="post">
    <div class="champ-form">
        <input class="form_in" type="password" name="mdp" placeholder="Changer de mot de passe"/>
    </div>
    <div class="champ-form">
        <input class="form_in" type="password" name="mdp2" placeholder="Confirmation du mot de passe"/>
    </div>
    <input type="submit" name="valid" value="Ok" id="valid" class="valide">
</form>
<div class="sign">
<a href="logout.php">Se déconnecter</a>
</div>
</div>