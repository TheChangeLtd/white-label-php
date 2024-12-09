<?php
$translationService = $context['translationService'];
$orderData = $context['orderData'];
?>

<div class="order__data-header">
    <h2 class="order__data-title"><?php echo $translationService->trans('exchange_completed'); ?></h2>
    <div class="order__session">
        <div class="order__session-label">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.18936 9.33333L5.46964 6.66667H2.6665V5.33333H5.60978L5.96012 2H7.30077L6.95044 5.33333H9.60977L9.9601 2H11.3008L10.9504 5.33333H13.3332V6.66667H10.8103L10.53 9.33333H13.3332V10.6667H10.3899L10.0396 14H8.6989L9.04924 10.6667H6.3899L6.03955 14H4.69887L5.04922 10.6667H2.6665V9.33333H5.18936ZM6.53004 9.33333H9.18937L9.46964 6.66667H6.8103L6.53004 9.33333Z" fill="#1F2938" />
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
                <g clip-path="url(#clip0_105_5736)">
                    <path d="M16.0033 11.4218L16.1126 11.4207V12.5204C16.0411 12.5169 16.0045 12.5145 16.0009 12.5145C15.5532 12.5145 15.3294 12.3291 15.3294 11.9552C15.3288 11.6008 15.5527 11.4218 16.0033 11.4218ZM16.6247 13.2085V14.3986H16.7333C17.2212 14.3986 17.4645 14.1895 17.4645 13.7714C17.4645 13.541 17.4096 13.391 17.3033 13.3172C17.1934 13.2445 16.9684 13.2085 16.6247 13.2085ZM20.5004 12.7856C20.5004 15.0649 18.6523 16.9141 16.373 16.9141C14.095 16.9141 12.2469 15.0649 12.2469 12.7856C12.2469 10.5058 14.095 8.65887 16.373 8.65887C18.6523 8.65828 20.5004 10.504 20.5004 12.7856ZM18.2324 13.7578C18.2324 13.3172 18.1331 13.0124 17.9347 12.8476C17.7386 12.6817 17.3565 12.5836 16.7918 12.5535L16.6241 12.5464V11.4218H16.7422C17.1586 11.4218 17.3671 11.5878 17.3671 11.9227L17.3706 12.0042H18.1042V11.8997C18.1042 11.4596 17.9985 11.1567 17.7906 10.996C17.5815 10.8342 17.1928 10.7527 16.6241 10.7527V10.3162H16.112V10.7527C15.5166 10.7527 15.1097 10.8377 14.8906 11.0072C14.6703 11.1767 14.5592 11.4909 14.5592 11.9522C14.5592 12.4265 14.6703 12.752 14.8882 12.9244C15.1061 13.0963 15.5154 13.1831 16.112 13.1831V14.4004L16.0004 14.398C15.6932 14.398 15.496 14.3579 15.4085 14.2781C15.3223 14.1972 15.2757 14.0194 15.2757 13.7418V13.6645H14.5167L14.5131 13.818C14.5131 14.2734 14.6218 14.5918 14.8398 14.7731C15.0565 14.9562 15.4339 15.0477 15.9691 15.0477L16.112 15.0513V15.5557H16.6241V15.0513L16.7812 15.0477C17.3175 15.0477 17.6937 14.9509 17.9093 14.7625C18.1237 14.5646 18.2324 14.2333 18.2324 13.7578ZM9.2069 13.1105L18.7539 3.56466L18.8289 0.835938L16.1002 0.912129L6.55437 10.4579L4.18121 10.211L1.55821 12.8329L6.17577 13.4879L6.83079 18.1049L9.4526 15.4824L9.2069 13.1105ZM5.96019 14.932C5.84148 15.1676 5.67728 15.408 5.45697 15.6266C4.78543 16.2987 3.53269 16.1321 3.53269 16.1321C3.53269 16.1321 3.36673 14.8788 4.03768 14.2067C4.25681 13.9876 4.49483 13.8234 4.73227 13.7023C4.09557 13.619 3.34192 13.8866 2.75719 14.4742C1.87951 15.3525 0.500977 19.1621 0.500977 19.1621C0.500977 19.1621 4.31115 17.7847 5.18942 16.907C5.77592 16.32 6.04347 15.5687 5.96019 14.932Z" fill="#22C55E" />
                </g>
                <defs>
                    <clipPath id="clip0_105_5736">
                        <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                    </clipPath>
                </defs>
            </svg>
        </div>
        <span class="details__status-label">
            <?php echo $translationService->trans('exchange_completed_successfully'); ?>
        </span>
        <span class="details__status-description">
            <?php echo $translationService->trans('leave_review'); ?>
        </span>
        <?php if (!empty($trustpilot)): ?>
            <a href="<?php echo $trustpilot; ?>" class="details__status-review">
                <?php echo $translationService->trans('leave_a_review'); ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="order__details-deposit">
        <div class="order__details-info order__status-sending">
            <div class="order__status-sending-flex">
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('you_send'); ?></div>
                    <div class="order__details-copy">
                        <div class="order__details-value">
                            <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['send']); ?>.svg" alt="<?php echo htmlspecialchars($orderData['send']); ?>">
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
                    <div class="order__details-data-address"><?php echo htmlspecialchars($orderData['sendAddress']); ?></div>
                </div>
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('you_receive'); ?></div>
                    <div class="order__details-copy">
                        <div class="order__details-value">
                            <img src="/assets/images/coins/<?php echo htmlspecialchars($orderData['receive']); ?>.svg" alt="<?php echo htmlspecialchars($orderData['receive']); ?>">
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
                    <div class="order__details-data-address"><?php echo htmlspecialchars($orderData['receiveAddress']); ?></div>
                </div>
            </div>
            <?php if (!empty($orderData['hashOut'])): ?>
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('hash_out'); ?></div>
                    <div class="order__details-copy">
                        <div class="order__details-hash">
                            <span id="hash-out" class="order__details-hash-item">
                                <?php echo htmlspecialchars($orderData['hashOut']); ?>
                            </span>
                        </div>
                        <div class="order__details-copy-button" data-copy-target="hash-out">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.83317 5.00033V2.50033C5.83317 2.04009 6.20627 1.66699 6.6665 1.66699H16.6665C17.1267 1.66699 17.4998 2.04009 17.4998 2.50033V14.167C17.4998 14.6272 17.1267 15.0003 16.6665 15.0003H14.1665V17.4996C14.1665 17.9602 13.7916 18.3337 13.3275 18.3337H3.33888C2.87549 18.3337 2.5 17.9632 2.5 17.4996L2.50217 5.83438C2.50225 5.37375 2.8772 5.00033 3.34118 5.00033H5.83317ZM7.49983 5.00033H14.1665V13.3337H15.8332V3.33366H7.49983V5.00033Z" fill="#646F93" fill-opacity="0.7" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($orderData['hashIn'])): ?>
                <div class="order__details-item">
                    <div class="order__details-label"><?php echo $translationService->trans('hash_in'); ?></div>
                    <div class="order__details-copy">
                        <div class="order__details-hash">
                            <span id="hash-in" class="order__details-hash-item">
                                <?php echo htmlspecialchars($orderData['hashIn']); ?>
                            </span>
                        </div>
                        <div class="order__details-copy-button" data-copy-target="hash-in">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.83317 5.00033V2.50033C5.83317 2.04009 6.20627 1.66699 6.6665 1.66699H16.6665C17.1267 1.66699 17.4998 2.04009 17.4998 2.50033V14.167C17.4998 14.6272 17.1267 15.0003 16.6665 15.0003H14.1665V17.4996C14.1665 17.9602 13.7916 18.3337 13.3275 18.3337H3.33888C2.87549 18.3337 2.5 17.9632 2.5 17.4996L2.50217 5.83438C2.50225 5.37375 2.8772 5.00033 3.34118 5.00033H5.83317ZM7.49983 5.00033H14.1665V13.3337H15.8332V3.33366H7.49983V5.00033Z" fill="#646F93" fill-opacity="0.7" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>