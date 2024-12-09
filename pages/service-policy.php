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
    <div class="rules">
        <div class="rules__container">
            <div class="rules__head">
                <p class="rules__pretitle"><?php echo $translationService->trans('rules__title'); ?></p>
                <h1 class="rules__title"><?php echo $translationService->trans('service_rules'); ?>
                </h1>
                <p class="rules__subtitle"><?php echo $translationService->trans('read_service_rules'); ?>
                </p>
            </div>
            <div class="rules__content-container">
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('goal_label'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('goal_description'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('exchange'); ?>
                    </h2>
                    <p class="rules__item-text">1.1 <?php echo $translationService->trans('exchange_1.1'); ?></p>
                    <p class="rules__item-text">1.2 <?php echo $translationService->trans('exchange_1.2'); ?></p>
                    <p class="rules__item-text">1.3 <?php echo $translationService->trans('exchange_1.3'); ?></p>
                    <p class="rules__item-text">1.4 <?php echo $translationService->trans('exchange_1.4'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('safety'); ?></h2>
                    <p class="rules__item-text">2.1 <?php echo $translationService->trans('safety_2.1'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('privacy'); ?></h2>
                    <p class="rules__item-text">3.1 <?php echo $translationService->trans('privacy_3.1'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('comissions_refund'); ?></h2>
                    <p class="rules__item-text">4.1 <?php echo $translationService->trans('comissions_refund_4.1'); ?>
                    </p>
                    <p class="rules__item-text">4.2 <?php echo $translationService->trans('comissions_refund_4.2'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('liability'); ?></h2>
                    <p class="rules__item-text">5.1 <?php echo $translationService->trans('liability_5.1'); ?></p>
                    <p class="rules__item-text">5.2 <?php echo $translationService->trans('liability_5.2'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('support'); ?></h2>
                    <p class="rules__item-text">6.1 <?php echo $translationService->trans('support_6.1'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('service_rights'); ?></h2>
                    <p class="rules__item-text">7.1 <?php echo $translationService->trans('service_rights_7.1'); ?></p>
                    <p class="rules__item-text">7.2 <?php echo $translationService->trans('service_rights_7.2'); ?></p>
                </div>
            </div>
            <div class="questions">
                <h3 class="questions__title"><?php echo $translationService->trans('any_questions'); ?></h3>
                <p class="questions__text"><?php echo $translationService->trans('read_faq_or'); ?></p>
                <a href="/<?php echo $lang; ?>/contacts"
                    class="questions__button"><?php echo $translationService->trans('contact_us'); ?></a>
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