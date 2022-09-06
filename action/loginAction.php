<!-- Connexion -->

<?php 
require_once './inc/function.php';

 reconnect_from_cookie();
if(isset($_SESSION['auth'])){
    header('Location: account.php');
    exit();
}
if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
    require_once './inc/db.php';
    $req = $db->prepare('SELECT * FROM `membres` WHERE (pseudo = :pseudo OR email = :pseudo) AND `confirmed_at` IS NOT NULL');  //Connexion par Email ou Pseudo //
    $req->execute(['pseudo' => $_POST['pseudo']]);
    $user = $req->fetch();
    if(password_verify($_POST['mdp'], $user->password)){ // Si le mot de passe correspont //
        $_SESSION['auth'] = $user;
$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
if($_POST['remember']){
    $remember_token = str_random(250);
    $db->prepare('UPDATE `membres` SET `remember_token` = ? WHERE `id` = ?')->execute([$remember_token, $user->id]);
    setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'Skeleton'), time() + 60 * 60 * 24 * 7);
}
        header('Location: account.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }
}
 
?>