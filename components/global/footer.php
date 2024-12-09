<footer class="footer">
    <div class="footer-content">
        <a href="/<?php echo $lang; ?>" class="footer__logo">
            <span class="footer__logo-link">
                <img src="/assets/icon.svg" alt="">
            </span>
            <p class="footer__logo-name">
                <?php echo $translationService->trans('common.logo_name'); ?>
            </p>
        </a>
        <div class="footer__info-content">
            <div class="footer__copyright">
                <p class="footer__text">© 2023-2024 <?php echo $translationService->trans('common.logo_name'); ?></p>
            </div>
            <nav class="footer__nav">
                <ul class="footer__nav-list">
                    <?php foreach ($footerMenu as $item): ?>
                        <li class="footer__nav-item">
                            <a href="/<?php echo $lang; ?><?php echo $item['path']; ?>" class="footer__nav-link">
                                <?php echo $translationService->trans($item['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</footer>