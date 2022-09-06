<!-- Oublie mot de passe reinitialisation -->

<?php
if(!empty($_POST) && !empty($_POST['email'])){
    require_once './inc/db.php';
    require_once './inc/function.php';
    $req = $db->prepare('SELECT * FROM `membres` WHERE `email` = ? AND `confirmed_at` IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        session_start();
        $reset_token = str_random(60);
        $db->prepare('UPDATE `membres` SET `reset_token` = ?, `reset_at` = NOW() WHERE `id` = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Les instructions de modification de mot du passe vous ont été envoyées par emails';
        mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien <a href=\"http://localhost:81/EspaceMembre/reset.php?id={$user->id}&token=$reset_token\">Reinitialiser mot de passe </a>");
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
    }
}
?>