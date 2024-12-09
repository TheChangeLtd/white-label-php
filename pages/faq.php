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
    <div class="faq">
        <div class="faq__container">
            <div class="faq__head">
                <p class="faq__pretitle">FAQ</p>
                <h1 class="faq__title"><?php echo $translationService->trans('faq_title'); ?></h1>
                <p class="faq__subtitle"><?php echo $translationService->trans('faq_description'); ?></p>
            </div>

            <div class="faq__items">
                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('what_is_the_change'); ?></span>
                        <span class="faq__icon"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('the_change_description'); ?>
                    </div>
                </div>

                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('amount_difference_question'); ?></span>
                        <span class="faq__icon faq__icon--open"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('amount_difference_answer'); ?>
                    </div>
                </div>
                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('exchange_duration_question'); ?></span>
                        <span class="faq__icon"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('exchange_duration_answer'); ?>
                    </div>
                </div>
                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('exchange_fee'); ?></span>
                        <span class="faq__icon"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('service_commission'); ?>
                    </div>
                </div>
                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('crypto_laundering_question'); ?></span>
                        <span class="faq__icon"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('service_compliance'); ?>
                    </div>
                </div>
                <div class="faq__item">
                    <div class="faq__question">
                        <span class="faq__question-text"><?php echo $translationService->trans('transaction_after_canceled'); ?>
                        </span>
                        <span class="faq__icon"></span>
                    </div>
                    <div class="faq__answer" style="display: none;">
                        <?php echo $translationService->trans('transaction_resume'); ?>
                    </div>
                </div>
            </div>

            <div class="questions">
                <h3 class="questions__title"><?php echo $translationService->trans('no_answer_found'); ?></h3>
                <p class="questions__text"><?php echo $translationService->trans('contact_support'); ?></p>
                <a href="/<?php echo $lang;?>/contacts" class="questions__button"><?php echo $translationService->trans('contact_us'); ?></a>
            </div>
        </div>
    </div>
    <?php
    include './components/global/footer.php';
    ?>
    <?php
    include './components/global/scripts.php';
    ?>
    <script src="/assets/js/faq.js"></script>
</body>

</html>