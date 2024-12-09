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
                <h1 class="rules__title"><?php echo $translationService->trans('privacy_rules'); ?>
                </h1>
                <p class="rules__subtitle"><?php echo $translationService->trans('read_privacy_rules'); ?>
                </p>
            </div>
            <div class="rules__content-container">
                <div class="rules__item">
                    <p class="rules__item-text"><?php echo $translationService->trans('privacy_policy_intro'); ?></p>
                    <p class="rules__item-text"><?php echo $translationService->trans('privacy_policy_scope'); ?>
                    </p>
                    <p class="rules__item-text"><?php echo $translationService->trans('privacy_policy_consent'); ?></p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('data_collection_title'); ?>
                    </h2>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('data_collection_categories.provided_data.title'); ?>
                    </h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('data_collection_categories.provided_data.description'); ?>
                    </p>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('data_collection_categories.collected_data.title'); ?>
                    </h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('data_collection_categories.collected_data.description'); ?>
                    </p>

                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('data_collection_categories.cookies.title'); ?>
                    </h3>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('data_collection_categories.cookies.description'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('data_processing_title'); ?>
                    </h2>
                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('data_processing_purposes'); ?>
                    </h3>
                    <ul class="rules__item-list">
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_processing_list.business_analytics'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_processing_list.customer_support'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_processing_list.compliance'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_processing_list.security'); ?>
                        </li>
                    </ul>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('data_sharing_title'); ?>
                    </h2>
                    <h3 class="rules__item-title--mini">
                        <?php echo $translationService->trans('data_sharing_conditions'); ?>
                    </h3>
                    <ul class="rules__item-list">
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_sharing_list.legal_requests'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_sharing_list.fraud_prevention'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('data_sharing_list.partners'); ?>
                        </li>
                    </ul>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('data_retention_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('data_retention_policy'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('data_protection_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('data_protection_measures'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('children_policy_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('children_policy_description'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('explicit_consent_title'); ?>
                    </h2>
                    <p class="rules__item-text">
                        <?php echo $translationService->trans('explicit_consent_description'); ?>
                    </p>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('user_rights_title'); ?>
                    </h2>
                    <ul class="rules__item-list">
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.access'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.rectification'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.erasure'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.objection'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.restriction'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.portability'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.complaint'); ?>
                        </li>
                        <li class="rules__item-list-element">
                            <?php echo $translationService->trans('user_rights_list.withdraw_consent'); ?>
                        </li>
                    </ul>
                </div>
                <div class="rules__item">
                    <h2 class="rules__item-title"><?php echo $translationService->trans('policy_changes_title'); ?>
                    </h2>
                    <p class="rules__item-text"><?php echo $translationService->trans('policy_changes_description'); ?>
                    </p>
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