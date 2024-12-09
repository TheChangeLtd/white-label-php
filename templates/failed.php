<?php
$translationService = $context['translationService'];
$orderData = $context['orderData'];
?>

<div class="order__data-header">
    <h2 class="order__data-title"><?php echo $translationService->trans('order_was_canceled'); ?></h2>
    <div class="order__session">
        <div class="order__session-label">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.18936 9.33333L5.46964 6.66667H2.6665V5.33333H5.60978L5.96012 2H7.30077L6.95044 5.33333H9.60977L9.9601 2H11.3008L10.9504 5.33333H13.3332V6.66667H10.8103L10.53 9.33333H13.3332V10.6667H10.3899L10.0396 14H8.6989L9.04924 10.6667H6.3899L6.03955 14H4.69887L5.04922 10.6667H2.6665V9.33333H5.18936ZM6.53004 9.33333H9.18937L9.46964 6.66667H6.8103L6.53004 9.33333Z"
                    fill="#1F2938" />
            </svg>
            <span>
                <?php echo $translationService->trans('session_id'); ?>
            </span>
        </div>
        <span class="order__session-id"><?php echo htmlspecialchars($orderData['id']); ?></span>
    </div>
</div>
<div class="order__details">
    <div class="order__details-status-content">
        <div class="details__status-icon">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.85839 3.04943C9.5719 1.75958 11.4262 1.75956 12.1398 3.04939L18.5946 14.7173C19.2859 15.967 18.382 17.4999 16.9539 17.4999H4.04468C2.61653 17.4999 1.71268 15.967 2.40398 14.7173L8.85839 3.04943ZM11.3314 14.1677C11.3314 13.7081 10.9588 13.3355 10.4992 13.3355C10.0396 13.3355 9.66699 13.7081 9.66699 14.1677C9.66699 14.6274 10.0396 15 10.4992 15C10.9588 15 11.3314 14.6274 11.3314 14.1677ZM11.1154 7.62336C11.0738 7.31833 10.8121 7.08341 10.4957 7.08366C10.1505 7.08394 9.87093 7.36398 9.87121 7.70916L9.87421 11.4605L9.87998 11.5453C9.92161 11.8503 10.1833 12.0852 10.4997 12.085C10.8449 12.0847 11.1245 11.8047 11.1242 11.4595L11.1212 7.70816L11.1154 7.62336Z"
                    fill="#EF4444" />
            </svg>
        </div>
        <span class="details__status-label">
            <?php echo $translationService->trans('order_was_canceled'); ?>
        </span>
        <span class="details__status-description">
            <?php echo $translationService->trans('due_to_expiration'); ?>
        </span>
        <a href="<?php echo $translationService->localePath("/contacts"); ?>"
            class="questions__button"><?php echo $translationService->trans('to_support'); ?></a>
    </div>
    <div class="order__details-deposit">
        <div class="order__details-info order__status-sending">
            <div class="order__status-sending-flex">
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('you_send'); ?></div>
                    <div class="order__details-copy">
                        <div class="order__details-value">
                            <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['send']); ?>.svg"
                                alt="<?php echo htmlspecialchars($orderData['send']); ?>">
                            <div class="order__details-value-item">
                                <span>
                                    <?php echo htmlspecialchars($orderData['sendAmount']); ?>
                                </span>
                                <span>
                                    <?php echo htmlspecialchars($orderData['send']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="order__details-data-address"><?php echo htmlspecialchars($orderData['sendAddress']); ?>
                    </div>
                </div>
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('you_receive'); ?>
                    </div>
                    <div class="order__details-copy">
                        <div class="order__details-value">
                            <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['receive']); ?>.svg"
                                alt="<?php echo htmlspecialchars($orderData['receive']); ?>">
                            <div class="order__details-value-item">
                                <span>
                                    <?php echo htmlspecialchars($orderData['receiveAmount']); ?>
                                </span>
                                <span>
                                    <?php echo htmlspecialchars($orderData['receive']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="order__details-data-address">
                        <?php echo htmlspecialchars($orderData['receiveAddress']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>