<?php

namespace App\Enums;

class TemplatesEnum
{
    private const TEMPLATES = [
        StatusEnum::AWAITING_DEPOSIT => 'deposit.php',
        StatusEnum::CONFIRMING_DEPOSIT => 'confirmation.php',
        StatusEnum::EXCHANGING => 'confirmation.php',
        StatusEnum::SENDING => 'sending.php',
        StatusEnum::COMPLETE => 'success.php',
        StatusEnum::FAILED => 'failed.php',
        StatusEnum::REFUND => 'failed.php',
        StatusEnum::ACTION_REQUEST => 'action-request.php',
    ];

    /**
     * Get the template path by status value.
     *
     * @param string $status The status value.
     * @return string|null The template path or null if not found or invalid.
     */
    public static function getTemplatePath(string $status): ?string
    {
        if (!in_array($status, array_keys(self::TEMPLATES), true)) {
            return null;
        }

        return self::TEMPLATES[$status];
    }
    
}