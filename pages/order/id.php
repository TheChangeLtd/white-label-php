<?php

use App\Services\OrderService;
use App\Services\ConfigService;
use App\Enums\StatusEnum;

/** @var \App\Renderers\TemplateRenderer $templateRenderer */

$apiKey = ConfigService::get('api_key');
$baseUrl = ConfigService::get('api_base_url');

$orderService = new OrderService($apiKey, $baseUrl);
if (!isset($id)) {
    exit('Не указан ID заказа.');
}

$orderData = $orderService->getOrderStatus($id);

if($orderData['httpCode'] === 404){
    header("Location: /404");
    exit;
}
$context = $orderData['content'];

$status = StatusEnum::AWAITING_DEPOSIT;

if (!isset($context)) {
    exit;
}
if (isset($context['status'])) {
    $status = $context['status'];
}

if (!isset($_SESSION['order_status']) || !is_array($_SESSION['order_status'])) {
    $_SESSION['order_status'] = [];
}

$_SESSION['order_status'][$id] = $status;

?>


<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <?php echo $metaTagsHtml; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/main.css">
    <link rel="shortcut icon" href="/assets/icon.svg" type="image/x-icon">
    <script src="/assets/plugins/jquery-3.6.0.js"></script>
    <script src="/assets/plugins/toastify.js"></script>
    <script src="/assets/js/theme-preload.js"></script>
</head>
<?php if ((isset($orderData) && !empty($orderData))): ?>

    <body>
        <?php
        include './components/global/header.php';
        ?>
        <?php
        include './components/global/background-svg.php';
        ?>
        <div class="page">
            <div class="page__container">
                <h1 class="order__title">
                    <?php echo $translationService->trans('exchange'); ?>
                    <span class="order__title-give">
                        <?php echo htmlspecialchars($context['send']); ?>
                    </span>
                    <?php echo $translationService->trans('to'); ?>
                    <span class="order__title-receive">
                        <?php echo htmlspecialchars($context['receive']); ?>
                    </span>
                </h1>
                <div class="order">
                    <div class="order__status">
                        <?php
                        try {
                            $templateRenderer->renderStepsTemplate($status);
                        } catch (Exception $e) {
                            echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
                        }
                        ?>
                    </div>
                    <div class="order__data">
                        <div id="order-container" class="order__data-container">
                            <?php
                            try {
                                if (!empty($context)) {
                                    $templateRenderer->renderTemplateByStatus($status, $context);
                                }
                            } catch (Exception $e) {
                                echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="order__info">
                    <div class="order__info-item">
                        <div class="order__info-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 4C6.86553 4 4.31818 6.69 4.31818 10H6.66667L3.37121 14L0 10H2.42424C2.42424 5.58 5.81439 2 10 2C11.4867 2 12.8693 2.46 14.0341 3.24L12.6515 4.7C11.8655 4.25 10.9564 4 10 4ZM13.3333 10L16.6288 6L20 10H17.5758C17.5758 14.42 14.1856 18 10 18C8.51326 18 7.13068 17.54 5.96591 16.76L7.34848 15.3C8.13447 15.75 9.04356 16 10 16C13.1345 16 15.6818 13.31 15.6818 10H13.3333Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <div class="order__info-description">
                            <h3 class="order__info-title"><?php echo $translationService->trans('automatic_exchange'); ?>
                            </h3>
                            <p class="order__info-text">
                                <?php echo $translationService->trans('order_auto_proceed'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="order__info-item">
                        <div class="order__info-icon">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_105_5765)">
                                    <path
                                        d="M10.3517 5.5C10.3511 5.5 10.3501 5.5 10.349 5.5C9.98207 5.5 9.68373 5.79699 9.68238 6.16402L9.66602 10.3514C9.66467 10.7194 9.96203 11.0194 10.33 11.0207C10.3307 11.0207 10.3317 11.0207 10.3327 11.0207C10.336 11.0207 10.3391 11.0198 10.3424 11.0198C10.3451 11.0198 10.3474 11.0207 10.3498 11.0207C10.3725 11.0207 10.3954 11.0144 10.4181 11.0121C10.4364 11.0101 10.4548 11.0088 10.4731 11.0051C10.5414 10.9921 10.6091 10.9721 10.6734 10.9365L15.9488 7.99914C16.2705 7.82013 16.3861 7.41412 16.2068 7.09249C16.0275 6.77081 15.6221 6.65516 15.2998 6.83448L11.0034 9.2265L11.0155 6.16948C11.0174 5.80097 10.7201 5.50129 10.3517 5.5Z"
                                        fill="currentColor" />
                                    <path
                                        d="M20.333 10C20.333 4.47699 15.856 0 10.333 0C4.81 0 0.333008 4.47699 0.333008 10C0.333008 10.8687 0.443995 11.7113 0.652364 12.5146C0.814034 11.573 1.63433 10.8536 2.62139 10.8536H2.71503C2.68372 10.5733 2.66637 10.2887 2.66637 10C2.66637 5.77268 6.10569 2.33337 10.333 2.33337C14.5603 2.33337 17.9996 5.77268 17.9996 10C17.9996 14.2273 14.5603 17.6666 10.333 17.6666C10.093 17.6666 9.85566 17.6539 9.62137 17.6323V17.8537C9.62137 18.7566 9.01936 19.521 8.19606 19.7687C8.88472 19.9187 9.59937 20 10.3331 20C15.856 20 20.333 15.523 20.333 10Z"
                                        fill="currentColor" />
                                    <path
                                        d="M8.95466 17.5398V12.8538C8.95466 12.1185 8.35664 11.5205 7.62134 11.5205H2.81837H2.6214C1.88604 11.5205 1.28809 12.1185 1.28809 12.8538V14.2665V17.8538C1.28809 18.5892 1.88611 19.1871 2.6214 19.1871H6.38106H7.6214C8.35676 19.1871 8.95472 18.5891 8.95472 17.8538L8.95466 17.5398ZM6.32866 15.5891L7.53432 16.7948C7.63397 16.8944 7.65597 17.0404 7.60332 17.1624C7.58696 17.1997 7.56502 17.2358 7.53432 17.2664L7.03399 17.7667C6.90363 17.8971 6.69263 17.8971 6.56264 17.7667L5.35698 16.5611C5.22663 16.4307 5.01563 16.4307 4.88564 16.5611L3.84263 17.6041L3.67998 17.7667C3.54963 17.8971 3.33862 17.8971 3.20864 17.7667L2.708 17.2664C2.57765 17.1361 2.57765 16.9251 2.708 16.7951L2.86066 16.6424L3.91397 15.5891C4.04432 15.4587 4.04432 15.2477 3.91397 15.1178L2.70837 13.9121C2.57801 13.7817 2.57801 13.5707 2.70837 13.4408L3.2087 12.9404C3.21936 12.9298 3.23303 12.9254 3.24467 12.9168C3.37533 12.8167 3.56066 12.8211 3.68035 12.9404L4.88601 14.1461C5.01636 14.2764 5.22737 14.2764 5.35735 14.1461L6.56301 12.9404C6.69336 12.8101 6.90437 12.8101 7.03435 12.9404L7.53469 13.4408C7.66504 13.5711 7.66504 13.7821 7.53469 13.9121L6.32902 15.1178C6.19867 15.2478 6.19867 15.4591 6.32866 15.5891Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_105_5765">
                                        <rect width="20" height="20" fill="white" transform="translate(0.333008)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="order__info-description">
                            <h3 class="order__info-title"><?php echo $translationService->trans('hours_payment'); ?></h3>
                            <p class="order__info-text">
                                <?php echo $translationService->trans('will_not_proceed'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="order__info-item">
                        <div class="order__info-icon order__info-icon--support">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.9267 19.4589C15.2052 19.1853 14.5901 18.8313 14.1055 18.4993C13.0427 18.9296 11.8815 19.1663 10.6667 19.1663C5.60406 19.1663 1.5 15.0623 1.5 9.99967C1.5 4.93707 5.60406 0.833008 10.6667 0.833008C15.7292 0.833008 19.8333 4.93707 19.8333 9.99967C19.8333 11.8987 19.255 13.6649 18.2649 15.1289C18.2021 16.3394 18.8378 17.4332 19.4977 18.401C20.0756 19.2486 19.9306 19.9317 18.853 19.9928C18.37 20.0201 17.3252 19.9892 15.9267 19.4589ZM3.16667 9.99967C3.16667 5.85754 6.52453 2.49967 10.6667 2.49967C14.8088 2.49967 18.1667 5.85754 18.1667 9.99967C18.1667 11.6249 17.6507 13.1273 16.7733 14.3548C16.3852 14.8982 16.5848 15.9162 16.718 16.5006C16.8472 17.0678 17.1277 17.6706 17.4047 18.1766C17.1395 18.1127 16.8426 18.0237 16.5177 17.9005C15.7699 17.6169 15.152 17.2183 14.7162 16.8838C14.4688 16.694 14.1362 16.6582 13.8542 16.7908C12.8878 17.2453 11.8081 17.4997 10.6667 17.4997C6.52453 17.4997 3.16667 14.1418 3.16667 9.99967ZM7.35834 12.7018C7.22857 12.1827 7.63849 11.6665 8.1668 11.6662H13.1668C13.6944 11.6665 14.105 12.1807 13.9752 12.6997C13.5437 14.1564 12.1545 14.9997 10.6668 14.9997C9.23617 14.9997 7.72418 14.1652 7.35834 12.7018ZM14.4167 8.33301C14.4167 9.02334 13.857 9.58301 13.1667 9.58301C12.4763 9.58301 11.9167 9.02334 11.9167 8.33301C11.9167 7.64265 12.4763 7.08301 13.1667 7.08301C13.857 7.08301 14.4167 7.64265 14.4167 8.33301ZM8.16667 9.58301C8.85702 9.58301 9.41667 9.02334 9.41667 8.33301C9.41667 7.64265 8.85702 7.08301 8.16667 7.08301C7.47631 7.08301 6.91667 7.64265 6.91667 8.33301C6.91667 9.02334 7.47631 9.58301 8.16667 9.58301Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <div class="order__info-description">
                            <h3 class="order__info-title"><?php echo $translationService->trans('support'); ?></h3>
                            <p class="order__info-text">
                                <?php echo $translationService->trans('if_questions'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <input id="order-id" type="hidden" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <?php
        include './components/global/footer.php';
        ?>
        <?php
        include './components/global/scripts.php';
        ?>
        <script type="module" src="/assets/js/order.js"></script>
    </body>
<?php endif; ?>

</html>