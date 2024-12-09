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
                <h1 class="rules__title"><?php echo $translationService->trans('aml_rules'); ?>
                </h1>
                <p class="rules__subtitle"><?php echo $translationService->trans('read_aml_rules'); ?>
                </p>
            </div>
            <div class="rules__content-container">
                <div class="rules__item">
                    <p class="rules__item-text"><?php echo $translationService->trans('aml_policy_intro'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('aml_measures_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('aml_measures_description'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('aml_system_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('aml_system_description'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('aml_procedures_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('aml_procedures_description'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('consent_guarantee_title'); ?>
                    </h2>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('consent_guarantee_description'); ?></p>
                    <ul class="rules__item-list">
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('consent_verification_items.photo_id'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('consent_verification_items.user_photo'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('consent_verification_items.real_time_check'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('consent_verification_items.sof_docs'); ?>
                        </li>
                    </ul>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title">
                        <?php echo $translationService->trans('verification_process_title'); ?>
                    </h2>
                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('verification_steps.conduct_verification.title'); ?></h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('verification_steps.conduct_verification.description'); ?>
                    </p>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('verification_steps.data_storage.title'); ?></h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('verification_steps.data_storage.description'); ?></p>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('verification_steps.positive_result.title'); ?></h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('verification_steps.positive_result.description'); ?></p>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('verification_steps.negative_result.title'); ?></h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('verification_steps.negative_result.description'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('liability_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('liability_description'); ?></p>
                </div>
            </div>
            <div class="questions">
                <h3 class="questions__title"><?php echo $translationService->trans('any_questions'); ?></h3>
                <p class="questions__text"><?php echo $translationService->trans('read_faq_or'); ?></p>
                <a href="/<?php echo $lang; ?>/contacts" class="questions__button"><?php echo $translationService->trans('contact_us'); ?></a>
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