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
    <div class="exchange">
        <div class="exchange__description">
            <h1 class="exchange__title"><?php echo $translationService->trans('title'); ?></h1>
            <p class="exchange__subtitle"><?php echo $translationService->trans('exchange_quickly'); ?></p>
        </div>
        <div class="exchange__form">
            <div class="exchange__form-group">
                <div class="exchange__form-content">
                    <div class="exchange__form-input-group">
                        <label for="give-amount"
                            class="exchange__form-label"><?php echo $translationService->trans('sell_label'); ?>
                        </label>
                        <input type="number" id="give-amount" class="exchange__form-input" placeholder="0.01" value="1">
                    </div>
                    <div class="exchange__form-currency give-currency">
                        <div class="exchange__form-current-token">
                            <div class="loader"></div>
                        </div>

                    </div>
                </div>
                <div class="exchange__form-hint">
                    <div class="exchange__form-limit" id="form-limit-min">
                        <span class="exchange__form-limit-label">Min:</span>
                        <div class="exchange__form-limit-value exchange__form-limit--min">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="exchange__form-limit"  id="form-limit-max">
                        <span class="exchange__form-limit-label">Max:</span>
                        <div class="exchange__form-limit-value exchange__form-limit--max">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
                <button class="exchange__form-button-reverse" id="reverse-currency">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.6665 8.3068C3.6665 8.3068 3.60888 11.7614 5.31888 14.241C7.03075 16.7207 10.6665 17.333 10.6665 17.333C10.6665 17.333 7.94675 15.1077 7.06688 12.9135C6.104 10.5137 6.6665 8.3068 6.6665 8.3068H9.6665L5.6665 2.66634L0.666504 8.3068H3.6665Z"
                            style="fill: var(--content-primary);" />
                        <path
                            d="M12.9328 7.08499C13.8957 9.3868 13.3332 11.9228 13.3332 11.9228H10.3332L14.3332 17.333L19.3332 11.9228H16.3332C16.3332 11.9228 16.3908 8.13023 14.6808 5.75183C12.9689 3.37344 9.33316 2.66634 9.33316 2.66634C9.33316 2.66634 12.0529 4.98043 12.9328 7.08499Z"
                            style="fill: var(--state-primary);" />
                    </svg>
                </button>
            </div>
            <div class="exchange__form-group">
                <div class="exchange__form-content">
                    <div class="exchange__form-input-group">
                        <label for="receive-amount"
                            class="exchange__form-label"><?php echo $translationService->trans('buy_label'); ?>
                        </label>
                        <div class="exchange__form-output" id="receive-amount">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="exchange__form-currency receive-currency">
                        <div class="exchange__form-current-token">
                            <div class="loader"></div>
                        </div>

                    </div>
                </div>
            </div>
            <button class="exchange__form-button"><?php echo $translationService->trans('exchange_button'); ?>
            </button>
        </div>
    </div>
    <?php
    include './components/global/footer.php';
    ?>
    <?php
    include './components/global/scripts.php';
    ?>
    <script type="module" src="/assets/js/exchange.js"></script>
</body>

</html>