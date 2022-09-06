<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Espace Membre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/fc7fce5b23.js" crossorigin="anonymous"></script>
</head>

<body>


<div>

    <?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div style="text-align:center; padding-top:50px; font-weight:bold;"<?= $type; ?>>
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

</div>
