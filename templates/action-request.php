<?php
$translationService = $context['translationService'];
$orderData = $context['orderData'];
?>

<div class="order__data-header">
    <h2 class="order__data-title"><?php echo $translationService->trans('order_was_paused_status'); ?></h2>
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
        <div class="details__status-icon action-request">
            <svg height="512px" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                    <path
                        d="M224,435.8V76.1c0-6.7-5.4-12.1-12.2-12.1h-71.6c-6.8,0-12.2,5.4-12.2,12.1v359.7c0,6.7,5.4,12.2,12.2,12.2h71.6   C218.6,448,224,442.6,224,435.8z" />
                    <path
                        d="M371.8,64h-71.6c-6.7,0-12.2,5.4-12.2,12.1v359.7c0,6.7,5.4,12.2,12.2,12.2h71.6c6.7,0,12.2-5.4,12.2-12.2V76.1   C384,69.4,378.6,64,371.8,64z" />
                </g>
            </svg>
        </div>
        <span class="details__status-label">
            <?php echo $translationService->trans('order_was_paused'); ?>
        </span>
        <span class="details__status-description">
            <?php echo $translationService->trans('due_to_request'); ?>
        </span>
        <a href="<?php echo $translationService->localePath("/contacts"); ?>"
            class="questions__button"><?php echo $translationService->trans('to_support'); ?></a>
    </div>
    <div class="order__details-deposit">
        <div class="order__details-info order__sending">
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