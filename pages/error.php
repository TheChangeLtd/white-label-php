<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <?php echo $metaTagsHtml; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/main.css">
    <link rel="shortcut icon" href="/assets/icon.svg" type="image/x-icon">
    <script src="/assets/plugins/jquery-3.6.0.js"></script>
    <script src="/assets/js/theme-preload.js"></script>
</head>

<body class="body__error">
    <?php
    include './components/global/header.php';
    ?>
    <?php
    include './components/global/background-svg.php';
    ?>
    <div class="error__page">
        <h1 class="error__title">
            <?php echo $translationService->trans('page_not_found'); ?>
        </h1>
        <p class="error__description">
            <?php echo $translationService->trans('page_not_exist'); ?>
        </p>
        <a class="error__home-button" href="/"><?php echo $translationService->trans('take_me_home'); ?></a>
    </div>
    <?php
    include './components/global/footer.php';
    ?>
    <?php
    include './components/global/scripts.php';
    ?>
</body>

</html>