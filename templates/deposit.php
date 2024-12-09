<?php
use App\Utils\QRCode;

$translationService = $context['translationService'];
$orderData = $context['orderData'];

$network = urlencode($orderData['sendNetwork']);
$address = urlencode($orderData['sendAddress']);
$amount = urlencode($orderData['sendAmount']);
if (isset($orderData['sendTag']) && !empty($orderData['sendTag'])){
    $sendTag = urlencode($orderData['sendTag']);
    $dataUriMemo = QRCode::generateQRCodeForMemo($sendTag);
}

$dataUriWithAddress = QRCode::generateQRCode($network, $address, null);
$dataUriWithAmount = QRCode::generateQRCode($network, $address, $amount);
?>

<div class="order__data-header">
    <h2 class="order__data-title"><?php echo $translationService->trans('waiting_for_deposit'); ?></h2>
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
    <div class="order__details-deposit">
        <div class="details__qr-code">
            <div class="details__qr-code-image">
                <div class="details__qr-code-image-item active" data-type="address">
                    <img src="<?php echo htmlspecialchars($dataUriWithAddress); ?>" alt="QR Code with Amount">
                </div>
                <div class="details__qr-code-image-item" data-type="amount">
                    <img src="<?php echo htmlspecialchars($dataUriWithAmount); ?>" alt="QR Code with Amount">
                </div>
                <?php if (isset($orderData['sendTag']) && !empty($orderData['sendTag'])): ?>
                    <div class="details__qr-code-image-item" data-type="memo">
                        <img src="<?php echo htmlspecialchars($dataUriMemo); ?>"
                            alt="QR Code with Memo">
                    </div>
                <?php endif; ?>
            </div>

            <div class="details__qr-switch">
                <div class="details__qr-switch-button active" data-target="address">
                    <?php echo $translationService->trans('address'); ?>
                </div>
                <div class="details__qr-switch-button" data-target="amount">
                    <?php echo $translationService->trans('with_amount'); ?>
                </div>
                <?php if (isset($orderData['sendTag']) && !empty($orderData['sendTag'])): ?>
                    <div class="details__qr-switch-button" data-target="memo">
                        <?php echo $translationService->trans('memo'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="details__expiration">
                <span class="details__expiration-label">
                    <?php echo $translationService->trans('expiration_time'); ?>
                </span>
                <span class="details__expiration-time" id="expiration-time"
                    data-created-at="<?php echo htmlspecialchars($orderData['createdAt']); ?>">
                    02:00:00
                </span>
            </div>
        </div>
        <div class="order__details-info">
            <div class="order__details-item">
                <div class="order__details-label"><?php echo $translationService->trans('you_send'); ?></div>
                <div class="order__details-copy">
                    <div class="order__details-value">
                        <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['send']); ?>.svg"
                            alt="coin img" />
                        <div class="order__details-value-item">
                            <span id="send-amount">
                                <?php echo htmlspecialchars($orderData['sendAmount']); ?>
                            </span>
                            <span>
                                <?php echo htmlspecialchars($orderData['send']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="order__details-copy-button" data-copy-target="send-amount">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.83317 5.00033V2.50033C5.83317 2.04009 6.20627 1.66699 6.6665 1.66699H16.6665C17.1267 1.66699 17.4998 2.04009 17.4998 2.50033V14.167C17.4998 14.6272 17.1267 15.0003 16.6665 15.0003H14.1665V17.4996C14.1665 17.9602 13.7916 18.3337 13.3275 18.3337H3.33888C2.87549 18.3337 2.5 17.9632 2.5 17.4996L2.50217 5.83438C2.50225 5.37375 2.8772 5.00033 3.34118 5.00033H5.83317ZM7.49983 5.00033H14.1665V13.3337H15.8332V3.33366H7.49983V5.00033Z"
                                fill="#646F93" fill-opacity="0.7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="order__details-item">
                <div class="order__details-label"><?php echo $translationService->trans('you_receive'); ?></div>
                <div class="order__details-copy">
                    <div class="order__details-value">
                        <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['receive']); ?>.svg"
                            alt="coin img" />
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
            </div>
            <div class="order__details-item">
                <div class="order__details-label">
                    <?php echo $translationService->trans('service_wallet_address'); ?>
                </div>
                <div class="order__details-copy">
                    <div class="order__details-address">
                        <span id="wallet-address" class="order__details-address-item">
                            <?php echo htmlspecialchars($orderData['sendAddress']); ?>
                        </span>
                    </div>
                    <div class="order__details-copy-button" data-copy-target="wallet-address">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.83317 5.00033V2.50033C5.83317 2.04009 6.20627 1.66699 6.6665 1.66699H16.6665C17.1267 1.66699 17.4998 2.04009 17.4998 2.50033V14.167C17.4998 14.6272 17.1267 15.0003 16.6665 15.0003H14.1665V17.4996C14.1665 17.9602 13.7916 18.3337 13.3275 18.3337H3.33888C2.87549 18.3337 2.5 17.9632 2.5 17.4996L2.50217 5.83438C2.50225 5.37375 2.8772 5.00033 3.34118 5.00033H5.83317ZM7.49983 5.00033H14.1665V13.3337H15.8332V3.33366H7.49983V5.00033Z"
                                fill="#646F93" fill-opacity="0.7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="order__details-item">
                <div class="order__details-label"><?php echo $translationService->trans('user_wallet_address'); ?>
                </div>
                <div class="order__details-copy">
                    <div class="order__details-address">
                        <span id="wallet-address" class="order__details-address-item">
                            <?php echo htmlspecialchars($orderData['receiveAddress']); ?>
                        </span>
                    </div>
                    <div class="order__details-copy-button" data-copy-target="wallet-address">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.83317 5.00033V2.50033C5.83317 2.04009 6.20627 1.66699 6.6665 1.66699H16.6665C17.1267 1.66699 17.4998 2.04009 17.4998 2.50033V14.167C17.4998 14.6272 17.1267 15.0003 16.6665 15.0003H14.1665V17.4996C14.1665 17.9602 13.7916 18.3337 13.3275 18.3337H3.33888C2.87549 18.3337 2.5 17.9632 2.5 17.4996L2.50217 5.83438C2.50225 5.37375 2.8772 5.00033 3.34118 5.00033H5.83317ZM7.49983 5.00033H14.1665V13.3337H15.8332V3.33366H7.49983V5.00033Z"
                                fill="#646F93" fill-opacity="0.7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>