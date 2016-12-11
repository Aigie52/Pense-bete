<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/main.css">
    <title><?= App::getInstance()->titrePage; ?></title>
</head>

<body>
<?php include(ROOT . '/app/Views/articles/modules/header.php'); ?>

<section class="container">
    <?= $content; ?>
</section>

<?php
if(isset($_SESSION['groupe']) && $_SESSION['groupe'] === 'admins'){
    include(ROOT . '/app/Views/articles/modules/footer.php');
}
?>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="../public/assets/js/main.js"></script>
<script src="../public/assets/js/bootstrap.min.js"></script>

</body>
</html>
