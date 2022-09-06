<?php 
require 'inc/header.php';
require 'action/loginAction.php';
 ?>



                                                            <!-- Formulaire de connexion -->  
                                                            <h1 class="title">Connexion</h1>

<div class="container">
  
    <form method="POST" action="#">
    <div class="champ-form">   
        <input type="text" name="pseudo" id="pseudo" class="form_in">
        <label for="pseudo" class="form_lab">Pseudo ou email : </label>
     
    </div>

    <div class="champ-form">   
        <input type="password" name="mdp" id="mdp" class="form_in">
        <label for="mdp" class="form_lab">Mot de passe : </label>
        <a href="forget.php"><i class="forget">J'ai oublié mon mot de passe</i></a>
     
        <div class="rememb">
            <label>
                <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
            </label>
        </div>

    </div>
    <input type="submit" name="valid" value="Connexion" id="valid" class="valide">
</form>
</div>

<div class="sign">
   <p>Vous n'avez pas de compte ? <a href="register.php">S'inscrire.</a></p> 
</div>

</body>
</html>