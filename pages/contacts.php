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

<body>
    <?php
    include './components/global/header.php';
    ?>
    <?php
    include './components/global/background-svg.php';
    ?>
    <div class="contacts">
        <div class="contacts__container">
            <div class="contacts__head">
                <p class="contacts__pretitle"><?php echo $translationService->trans('contacts__title'); ?></p>
                <h1 class="contacts__title"><?php echo $translationService->trans('contact_us'); ?>
                </h1>
                <p class="contacts__subtitle"><?php echo $translationService->trans('have_questions'); ?>
                </p>
            </div>
            <div class="contacts__item">
                <h2 class="contacts__item-title">
                    <?php echo $translationService->trans('contact_details'); ?>
                </h2>
                <div class="contacts__item-wrapper">
                    <?php foreach ($contacts as $key => $contact): ?>
                        <a href="<?= htmlspecialchars($contact['link']) ?>" class="contacts__item-contact" >
                            <div class="contacts__contact-icon" style="background-color: <?= htmlspecialchars($contact['background_color']) ?>;">
                                <?= $contact['icon'] ?>
                            </div>
                            <div class="contacts__contact-discription">
                                <p class="contacts__contact-title"><?= ucfirst($key) ?></p>
                                <p class="contacts__contact-detail"><?= htmlspecialchars($contact['label']) ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include './components/global/footer.php';
    ?>
    <?php
    include './components/global/scripts.php';
    ?>
</body>

</html>