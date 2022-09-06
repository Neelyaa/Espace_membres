
<!-- Modification mot de passe  -->

<?php
if(isset($_GET['id']) && isset($_GET['token'])){
    require './inc/db.php';
    require './inc/function.php';
    $req = $db->prepare('SELECT * FROM `membres` WHERE `id` = ? AND `reset_token` IS NOT NULL AND `reset_token` = ? AND `reset_at` > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['mdp']) && $_POST['mdp'] == $_POST['mdp2']){
                $mdpCrypt = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
                $db->prepare('UPDATE `membres` SET `password` = ?, `reset_at` = NULL, `reset_token` = NULL WHERE `id` = ?')->execute([$mdpCrypt, $_GET['id']]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                $_SESSION['auth'] = $user;
                header('Location: account.php');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['error'] = "Ce token n'est pas valide";
        header('Location: login.php');
        exit();
    }
}else{
    header('Location: login.php');
    exit();
}
?>