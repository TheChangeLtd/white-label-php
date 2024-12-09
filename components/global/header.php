<header class="header">
    <div class="header__container">
        <a href="/<?php echo $lang; ?>/" class="header__logo">
            <span class="header__logo-link">
                <img src="/assets/icon.svg" alt="">
            </span>
            <p class="header__logo-name">
                <?php echo $translationService->trans('common.logo_name'); ?>
            </p>
        </a>
        <div class="header__group">
            <nav class="header__nav">
                <ul class="header__nav-list">
                    <?php foreach ($headerMenu as $item): ?>
                        <li class="header__nav-item">
                            <a href="/<?php echo $lang; ?><?php echo $item['path']; ?>" class="header__nav-link">
                                <?php echo $translationService->trans($item['label']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="header__theme-switcher">
                <button class="header__theme-button header__theme-button--light active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.9085 1.97925V3.96265C10.9085 4.64065 10.6117 4.9668 9.99338 4.9668C9.37511 4.9668 9.07824 4.64065 9.07824 3.96265V1.97925C9.07824 1.32615 9.37511 1 9.99338 1C10.6117 1 10.9085 1.32615 10.9085 1.97925ZM12.7641 4.59004L13.9025 2.95849C14.2738 2.45642 14.744 2.356 15.2135 2.70706C15.6829 3.05811 15.7328 3.51038 15.3623 4.06306L14.2239 5.6697C13.8526 6.22239 13.4077 6.27219 12.913 5.92114C12.4427 5.56929 12.3936 5.14192 12.7641 4.59004ZM6.08425 2.9834L7.24718 4.59004C7.61846 5.14272 7.56858 5.56929 7.07381 5.92034C6.60357 6.29709 6.15867 6.22158 5.78739 5.6689L4.62447 4.06226C4.25319 3.50957 4.30306 3.08301 4.79784 2.73196C5.26807 2.3552 5.71297 2.43071 6.08425 2.9834ZM9.99338 6.09626C12.1213 6.09626 13.8526 7.85393 13.8526 10.0125C13.8526 12.1461 12.1205 13.8788 9.99338 13.8788C7.86624 13.8788 6.13413 12.1469 6.13413 10.0125C6.13413 7.85313 7.86624 6.09626 9.99338 6.09626ZM2.76965 6.64895L4.6498 7.25144C5.26807 7.45227 5.49131 7.82903 5.2934 8.43152C5.12003 9.03401 4.69967 9.20994 4.05607 9.0091L2.225 8.40661C1.60673 8.20578 1.38349 7.80412 1.55685 7.20163C1.75477 6.62405 2.15138 6.44812 2.76965 6.64895ZM15.3615 7.25144L17.2171 6.64895C17.8607 6.44812 18.2565 6.62405 18.4291 7.20163C18.627 7.80412 18.4046 8.20578 17.761 8.38171L15.9299 9.0091C15.3116 9.20994 14.9158 9.03401 14.7179 8.43152C14.5445 7.82903 14.7424 7.45227 15.3615 7.25144ZM2.225 11.5942L4.08061 10.9917C4.69888 10.7909 5.12003 10.9411 5.29261 11.5444C5.49052 12.1469 5.26807 12.5236 4.64901 12.7245L2.76886 13.3519C2.15059 13.5527 1.75477 13.3768 1.55685 12.7743C1.38349 12.1718 1.60673 11.795 2.225 11.5942ZM15.9307 10.9917L17.7863 11.5942C18.4046 11.795 18.6278 12.1718 18.4299 12.7743C18.2565 13.3768 17.8607 13.5527 17.2179 13.3519L15.3623 12.7245C14.7187 12.5236 14.5461 12.1469 14.7187 11.5444C14.9166 10.9419 15.3124 10.7909 15.9307 10.9917ZM4.62526 15.912L5.78818 14.3303C6.15946 13.7776 6.60436 13.7029 7.0746 14.0789C7.56937 14.4307 7.61925 14.8573 7.24797 15.4092L6.08505 16.9909C5.71377 17.5436 5.26886 17.644 4.77409 17.2921C4.30385 16.9403 4.25477 16.4647 4.62526 15.912ZM14.2239 14.3303L15.3623 15.912C15.7336 16.4647 15.6837 16.9411 15.2135 17.2929C14.7432 17.6448 14.273 17.5187 13.9025 17.0166L12.7641 15.41C12.3928 14.8573 12.4427 14.4307 12.913 14.0797C13.4077 13.7278 13.8534 13.7776 14.2239 14.3303ZM10.9085 16.0125V17.9958C10.9085 18.6739 10.6117 19 9.99338 19C9.37511 19 9.07824 18.6739 9.07824 17.9958V16.0125C9.07824 15.3344 9.37511 15.0083 9.99338 15.0083C10.6117 15.0083 10.9085 15.3344 10.9085 16.0125Z"
                            fill="currentColor" fill-opacity="0.7" />
                    </svg>
                    <span><?php echo $translationService->trans('common.theme.light'); ?></span>
                </button>
                <button class="header__theme-button header__theme-button--dark">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.83301 9.99967C5.83301 11.1047 6.27199 12.1646 7.0534 12.946C7.8348 13.7274 8.89461 14.1663 9.99967 14.1663V5.83301C8.89461 5.83301 7.8348 6.27199 7.0534 7.0534C6.27199 7.8348 5.83301 8.89461 5.83301 9.99967Z"
                            fill="currentColor" fill-opacity="0.7" />
                        <path
                            d="M9.99995 1.00009C8.21993 1.00009 6.47988 1.52793 4.99985 2.51686C3.51982 3.50579 2.36627 4.91139 1.68508 6.55591C1.0039 8.20044 0.82567 10.01 1.17294 11.7558C1.5202 13.5017 2.37736 15.1053 3.63603 16.364C4.89469 17.6226 6.49833 18.4798 8.24415 18.8271C9.98997 19.1743 11.7996 18.9961 13.4441 18.3149C15.0886 17.6337 16.4942 16.4802 17.4831 15.0002C18.4721 13.5201 18.9999 11.7801 18.9999 10C19.0053 8.81664 18.7762 7.64389 18.3259 6.54952C17.8755 5.45515 17.2128 4.46085 16.376 3.62404C15.5392 2.78724 14.5449 2.12451 13.4505 1.67414C12.3561 1.22377 11.1834 0.994678 9.99995 1.00009ZM2.63636 10C2.6471 8.05041 3.42635 6.18369 4.80498 4.80507C6.1836 3.42645 8.05032 2.64719 9.99995 2.63645V5.90916C11.0849 5.90916 12.1255 6.34016 12.8926 7.10735C13.6598 7.87454 14.0908 8.91507 14.0908 10C14.0908 11.085 13.6598 12.1255 12.8926 12.8927C12.1255 13.6599 11.0849 14.0909 9.99995 14.0909V17.3636C8.05032 17.3529 6.1836 16.5736 4.80498 15.195C3.42635 13.8164 2.6471 11.9497 2.63636 10Z"
                            fill="currentColor" fill-opacity="0.7" />
                    </svg>
                    <span><?php echo $translationService->trans('common.theme.dark'); ?></span>
                </button>
            </div>
            <div class="header__language">
                <span class="header__language-toggle">
                    <img src="/assets/images/lang/<?php echo $lang; ?>.svg" alt="<?php echo strtoupper($lang); ?>"
                        width="20">
                    <?php echo strtoupper($lang); ?>
                    <span class="header__language-arrow">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 7.5L10 12.5L5 7.5" stroke="currentColor" stroke-opacity="0.7" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </span>
                <div class="header__language-popup">
                    <?php foreach ($supportedLanguages as $langCode => $locale): ?>
                        <?php if ($lang !== $langCode): ?>
                            <a
                                href="/<?php echo $langCode; ?><?php echo str_replace("/$lang", '', $_SERVER['REQUEST_URI']); ?>">
                                <img src="/assets/images/lang/<?php echo $langCode; ?>.svg"
                                    alt="<?php echo strtoupper($langCode); ?>" width="20">
                                <?php echo strtoupper($langCode); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="/<?php echo $lang; ?>/" class="header__button">
                <?php echo $translationService->trans('common.exchange'); ?>
            </a>
        </div>
        <div class="header__burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<div class="overflow__full"></div>