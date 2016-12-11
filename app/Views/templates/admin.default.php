<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/main.css">
    <title><?= App::getInstance()->titrePage; ?></title>
</head>

<body>
<?php include(ROOT . '/app/Views/admin/modules/header.php'); ?>

<section class="container">
    <?= $content; ?>
</section>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script   src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"   integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo="   crossorigin="anonymous"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../public/assets/js/main.js"></script>
</body>
</html>
