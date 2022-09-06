<?php
require __DIR__ . '../../vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;



// Affichage erreurs //
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once './inc/function.php';

// Conditions //
if (!empty($_POST['valid'])) {

    // Fichier BDD //
    require_once './inc/db.php';


    // Conditions Pseudo //

    if (empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {

        $erreur['pseudo'] = "Votre pseudo n'est pas valide !";
    } else { // Verifie la BDD //
        $req = $db->prepare('SELECT `id` FROM `membres` WHERE `pseudo` = ?');
        $req->execute([$_POST['pseudo']]);
        $user = $req->fetch();
        if ($user) {   // Si l'utilisateur existe //
            $erreur['pseudo'] = 'Ce pseudo est déjà pris !';
        }
    }
    // Condition Adresse mail //

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreur['email'] = "Votre email n'est pas valide !";
    } else {
        $req = $db->prepare('SELECT `id` FROM `membres` WHERE `email` = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $erreur['mail'] = 'Cette adresse mail est déjà utilisé pour un autre compte !';
        }
    }

    // Condition mot de passe //
    if (empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp2']) {
        $erreur['mdp'] = "Vos mot de passe ne correspondent pas !";
    }

    // Si il n'y a pas d'erreur on enregistre dans la BD //
    if (empty($erreur)) {
        $req = $db->prepare("INSERT INTO `membres` SET `pseudo` = ?, `password` = ?, `email` = ?, `confirmation_token` = ?");
        $mdpCrypt = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['pseudo'], $mdpCrypt, $_POST['email'], $token]);
        $user_id = $db->lastInsertId();
        $transport = Transport::fromDsn('smtp://localhost:1025');
        $mailer = new Mailer($transport);
        
        $email = (new Email())
            ->from('itsme@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Validation inscription')
            ->html("Bienvenue! Afin de valider votre compte merci de cliquer sur ce lien <a href=\"http://localhost:81/EspaceMembre/confirm.php?id=$user_id&token=$token\">Confirmer mon compte</a>")
            ->text('<p>Votre compte a était confirmé. Vous êtes désormais inscrit</p>');
        
        $mailer->send($email);
    
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location: login.php');
        exit();
    }
}
?>
